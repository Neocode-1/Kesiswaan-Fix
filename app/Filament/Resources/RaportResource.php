<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Raport;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\RaportResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as Sections;
use App\Filament\Resources\RaportResource\RelationManagers;

class RaportResource extends Resource
{
    protected static ?string $model = Raport::class;

    // protected static ?string $slug = 'raport';
    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';

    protected static ?string $navigationlabel = 'Nilai Raport';

    protected static ?string $label = 'Nilai Siswa';

    protected static ?string $getNavigationLabel = 'Raport Nilai';

    protected static ?string $navigationGroup = 'Management Nilai';
    // protected static ?string $navigationParentItem = 'Ijazah';
    protected static ?int $navigationShort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Data Lengkap')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->completedIcon('heroicon-m-clipboard-document-check')
                        ->schema([
                            Section::make()
                                ->description('Masukan Data lengkap siswa')
                                ->schema([
                                    Select::make('siswa_id')
                                        ->label('Nama Siswa')
                                        ->preload()
                                        ->prefixIcon('heroicon-o-user')
                                        ->prefixIconColor('primary')
                                        ->relationship('siswa', 'nama')
                                        ->placeholder('Masukkan Nama Siswa'),

                                    FileUpload::make('upload_file')
                                        ->placeholder('Masukan file nilai')
                                        ->label('file nilai')
                                        ->required(),

                                    Textarea::make('catatan')
                                        ->label('catatan siswa'),

                                    Select::make('klasifikasi_id')
                                        ->label('Tahun Masuk Siswa')
                                        ->preload()
                                        ->prefixIcon('heroicon-o-user')
                                        ->prefixIconColor('primary')
                                        ->relationship('klasifikasi', 'tahun_masuk')
                                        ->placeholder('Masukkan Tahun Masuk Siswa'),
                                ])
                        ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('siswa.nama')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->icon('heroicon-o-user')
                    ->iconColor('primary'),
                TextColumn::make('upload_file')
                    ->label('file raport')
                    ->Colors(['info'])
                    ->badge()
                    ->searchable()
                    ->Icon('heroicon-o-document-check'),

                TextColumn::make('klasifikasi.tahun_masuk')
                    ->label('Tahun masuk')
                    ->icon('heroicon-o-calendar-days')
                    ->colors(['info'])
                    ->searchable()
                    ->badge(),

                // TextColumn::make('catatan')
                // ->label('Catatan Siswa')
                // ->iconColor('info')
                // ->searchable()
                // ->icon('heroicon-o-clipboard-document-list'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->tooltip('Edit'),
                    Tables\Actions\ViewAction::make()->tooltip('View'),
                    Tables\Actions\DeleteAction::make()->tooltip('Delete'),

                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Sections::make('Data Nilai Siswa')
                    ->icon('heroicon-o-cloud-arrow-up')
                    ->description('Hasil rekapan nilai tahunan siswa')
                    ->aside()
                    ->schema([
                        TextEntry::make('siswa.nama')
                            ->label('Nama Siswa')
                            ->iconColor('velvet')
                            ->size(TextEntry\TextEntrySize::Medium)
                            ->weight(FontWeight::Thin)
                            ->colors(['info'])
                            ->icon('heroicon-o-user'),

                        TextEntry::make('upload_file')
                            ->label('File Nilai')
                            ->size(TextEntry\TextEntrySize::Medium)
                            ->colors(['info'])
                            ->weight(FontWeight::Thin)
                            ->copyable()
                            ->icon('heroicon-o-document-text')
                            ->iconColor('velvet')
                            ->copyMessage('berhasil di copy'),
                        // ->badge()

                        TextEntry::make('klasifikasi.tahun_masuk')
                            ->label('Tahun Masuk')
                            ->colors(['info'])
                            ->iconColor('velvet')
                            ->weight(FontWeight::Thin)
                            ->size(TextEntry\TextEntrySize::Medium)
                            ->icon('heroicon-o-calendar'),

                        TextEntry::make('catatan')
                            ->label('Catatan')
                            ->icon('heroicon-o-pencil-square')
                            ->weight(Fontweight::Thin)
                            ->size(TextEntry\TextEntrySize::Medium)
                            ->colors(['info'])
                            ->iconColor('velvet'),

                    ])

            ]);
    }



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $raportData = Raport::all()->count();
        $stringCount = strval($raportData);
        return $stringCount;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRaports::route('/'),
            'create' => Pages\CreateRaport::route('/create'),
            'edit' => Pages\EditRaport::route('/{record}/edit'),
            'view' => Pages\ViewRaport::route('/{record}/view'),
        ];
    }

    public static function getLabel(): string
    {
        return 'Nilai Raport';
    }


    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total raport';
    }
}
