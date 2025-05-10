<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelasResource\Pages;
use App\Filament\Resources\KelasResource\RelationManagers;
use App\Models\Kelas;
use Filament\Infolists\Infolist;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Infolists\Components\Section as Sections;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions\Action;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Fieldset;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KelasResource extends Resource
{
    protected static ?string $model = Kelas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Kelas';

    public static ?string $label = 'Info';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns()

                    ->schema([
                        TextInput::make('absensi_id')
                            ->label('Nama Siswa')
                            ->placeholder('Masukan nama siswa')

                            ->required(),

                        Select::make('kategori')
                            ->label('Tingkat')
                            ->options([
                               'SD' => 'SD',
                               'SMP'=> 'SMP',
                               'SMA' => 'SMA'
                            ])
                            ->native(false)
                            ->searchable()
                            ->placeholder('masukan tingkat siswa')
                            ->required(),
                        Select::make('tingkat')
                            ->label('Kelas')
                            ->options([
                               1, 2, 3, 4, 5, 6
                            ])
                            ->native(false)
                            ->searchable()
                            ->placeholder('masukan tingkat siswa')
                            ->required(),

                        TextInput::make('kebutuhan')
                            ->label('Siswa ber kebutuhan')
                            ->placeholder('masukan keterangan nya')
                            ->required(),

                        Select::make('nama_kelas')
                            ->label('Nama kelas')
                            ->required()
                            ->options([
                                'Bag A', 'Bag B', 'Bag C', 'Bag DS', 'Bag D1', 'Autis'
                            ])
                            ->searchable()
                            ->placeholder('masukan nama kelas'),

                        Select::make('kebutuhan')
                            ->label('Nama kelas')
                            ->required()
                            ->options([
                                'Tunarungu' => 'Tunarungu',
                                'Tunagrahita' => 'Tunagrahita',
                                'Tunawicara' => 'Tunawicara',
                                'Tunanetra' => 'Tunanetra',
                                'Tunadaksa' => 'Tunadaksa',
                                'Autis' =>  'Autis'
                                ])
                            ->searchable()
                            ->placeholder('masukan nama kelas')
                    ])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->poll('5s')
            ->columns([
                TextColumn::make('absensi.admin.name')
                    ->label('Nama Siswa')
                    ->icon('heroicon-o-user')
                    ->iconColor('green')
                    ->searchable(),

                TextColumn::make('tingkat')
                    ->label('Tingkatan')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->colors(['lime'])
                    ->badge()
                    ->searchable(),

                TextColumn::make('nama_kelas')
                    ->label('Nama kelas')
                    ->copyable()
                    ->copyMessage('nama kelas berhasil di salin')
                    ->icon('heroicon-o-building-library')
                    ->Colors(['info'])
                    ->badge()

                    ->searchable(),

                    TextColumn::make('kebutuhan')
                    ->colors([
                        'sky' => 'Tunarungu',
                        'warning' => 'Autis',
                        'success' => 'Tunadaksa',
                        'info' => 'Tunawicara',
                        'blue' => 'Tunagrahirta'
                    ])
                    ->badge()
                    ->label('Kebutuhan Khusus'),


            ])
            ->filters([
                SelectFilter::make('kebutuhan')
                    ->label('Kebutuhan Khusus')
                    ->options([
                        'Tunarungu' => 'TUNARUNGU',
                        'Autis' => 'AUTIS',
                        'Tunagrahirta' => 'TUNAGRAHIRTA',
                        'Tunawicara' => 'TUNAWICARA',
                        'Tunadaksa' => 'TUNADAKSA',

                    ])
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

    public static function infolist(Infolist $infolist): Infolist {
        return $infolist
        ->schema([
            Sections::make('Info Siswa')
            ->description('The items you have selected for purchase')
            ->icon('heroicon-m-shopping-bag')
            ->aside()
            // ->columns()

    ->schema([
        TextEntry::make('absensi.admin.name')
        ->label('Nama Siswa')
        ->icon('heroicon-o-user')
        ->badge()
        ->colors([
            'green'
        ])
        ->iconColor('primary'),

        TextEntry::make('tingkat')
        ->label('Tingkat siswa')
        ->colors(['green'])
        ->badge()
        ->icon('heroicon-o-arrow-up-tray'),

        Textentry::make('kebutuhan')
        ->label('Kebutuhan Khusus')
        ->colors([
            'sky' => 'Tunarungu',
            'warning' => 'Autis',
            'success' => 'Tunadaksa',
            'info' => 'Tunawicara',
            'blue' => 'Tunagrahirta'
        ])
        ->badge(),

        TextEntry::make('nama_kelas')
        ->label('Nama Kelas')
        ->colors(['green'])
        ->icon('heroicon-o-building-library')
        ->badge(),
        ])

        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getLabel(): string {
        return 'Info';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelas::route('/'),
            'create' => Pages\CreateKelas::route('/create'),
            'edit' => Pages\EditKelas::route('/{record}/edit'),
            'view' => Pages\ViewKelas::route('/{record}/view'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $kelasData = Kelas::all()->count();
        $stringCount = strval($kelasData);
        return $stringCount;
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total kebutuhan';
    }
}
