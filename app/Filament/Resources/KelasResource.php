<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kelas;
use App\Models\Siswa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\TextInputColumn;
use App\Filament\Resources\KelasResource\Pages;
use Filament\Infolists\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as Sections;
use App\Filament\Resources\KelasResource\RelationManagers;

class KelasResource extends Resource
{
    protected static ?string $model = Kelas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Kelas';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    // ->icon('heroicon-o-clipboard-document-list')
                    // ->completedIcon('heroicon-m-clipboard-document-check')
                    ->schema([
                        Repeater::make('kelas_id')
                            ->relationship('siswas')
                            ->label('Daftar Siswa')
                            ->schema([
                                Select::make('siswa_id')
                                    ->label('no Siswa')
                                    ->options(Siswa::all()->pluck('no', 'id')->unique())
                                    ->searchable()
                                    ->prefixIcon('heroicon-o-user')
                                    ->prefixIconColor('primary')
                                    ->required(),
                                TextInput::make('nisn')
                                    ->placeholder('Masukkan NISN Siswa')
                                    ->label('NISN Siswa')
                                    ->prefixIcon('heroicon-o-academic-cap')
                                    ->prefixIconColor('primary')
                                    ->required()
                                    ->rule('digits:10')
                                    ->validationMessages([
                                        'required' => 'NISN nya kosong nih harap diisi terlebih dahulu ya',
                                        'digits' => 'NISN harus terdiri dari 10 digit angka aja bro.',
                                    ]),
                            ]),

                        Select::make('tingkat')
                            ->label('Tingkat')
                            ->options([
                                'SD',
                                'SMP',
                                'SMA'
                            ])
                            ->native(false)
                            ->searchable()
                            ->placeholder('masukan tingkat siswa')
                            ->required(),
                        Select::make('no_kelas')
                            ->label('No kelas')
                            ->required()
                            ->options([
                                '1',
                                '2',
                                '3',
                                '4',
                                '5',
                                '6'
                            ])
                            ->placeholder('masukan no kelas'),
                        Select::make('disabilitas')
                            ->label('Keterangan Disabilitas')
                            ->required()
                            ->options([
                                'A (Tunanetra)' => 'A (Tunanetra)',
                                'B (Tunarungu)' => 'B (Tunarungu)',
                                'C (Tunagrahita)' => 'C (Tunagrahita)',
                                'DS (Down Syndrom)' => 'DS (Down Syndrom)',
                                'D1 (Tunadaksa)' => 'D1 (Tunadaksa)',
                                'H/Au (Autis)' => 'H/Au (Autis)'
                            ])
                            ->placeholder('masukan no kelas'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategori')
                    ->label('Tingkat')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('no_kelas')
                    ->label('No kelas')
                    ->copyable()
                    ->copyMessage('No kelas berhasil di salin')
                    ->icon('heroicon-o-building-library')
                    ->colors([
                        'sky' => 'A (Tunanetra)',
                        'purple' => 'B (Tunarungu)',
                        'success' => 'C (Tunagrahita)',
                        'info' => 'DS (Down Syndrom)',
                        'pink' => 'D1 (Tunadaksa)',
                        'orange' => 'H/Au (Autis)'
                    ])
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->label('Jenjang Pendidikan')
                    ->options([
                        '1 SD',
                        '2 SD',
                        '3 SD',
                        '4 SD',
                        '5 SD',
                        '6 SD',
                        '1 SMP',
                        '2 SMP',
                        '3 SMP',
                        '1 SMA',
                        '2 SMA',
                        '3 SMA'
                    ]),
                SelectFilter::make('tingkat')
                    ->label('Kelas')
                    ->options([
                        '1 SD',
                        '2 SD',
                        '3 SD',
                        '4 SD',
                        '5 SD',
                        '6 SD',
                        '1 SMP',
                        '2 SMP',
                        '3 SMP',
                        '1 SMA',
                        '2 SMA',
                        '3 SMA'
                    ]),
                SelectFilter::make('no_kelas')
                    ->label('Kebutuhan Khusus')
                    ->options([
                        'A (Tunanetra)' => 'A  (Tunanetra)',
                        'B (Tunarungu)' => 'B (Tunarungu)',
                        'C (Tunagrahita)' => 'C (Tunagrahita)',
                        'DS (Down Syndrom)' => 'DS (Down Syndrom)',
                        'D1 (Tunadaksa)' => 'D1 (Tunadaksa)',
                        'H/Au (Autis)' => 'H/Au (Autis)'
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Sections::make('Kelas Siswa')
                    ->description('The items you have selected for purchase')
                    ->icon('heroicon-m-shopping-bag')
                    ->aside()
                    // ->columns()

                    ->schema([
                        TextEntry::make('siswas.no')
                            ->label('no Siswa')
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

                        // Textentry::make('kebutuhan')
                        //     ->label('Kebutuhan Khusus')
                        //     ->colors([
                        //         'sky' => 'Tunarungu',
                        //         'purple' => 'Autis',
                        //         'success' => 'Tunadaksa',
                        //         'info' => 'Tunawicara',
                        //         'blue' => 'Tunagrahirta'
                        //     ])
                        //     ->badge(),

                        TextEntry::make('no_kelas')
                            ->label('no Kelas')
                            ->colors([
                                'sky' => 'A (Tunanetra)',
                                'purple' => 'B (Tunarungu)',
                                'success' => 'C (Tunagrahita)',
                                'info' => 'DS (Down Syndrom)',
                                'pink' => 'D1 (Tunadaksa)',
                                'orange' => 'H/Au (Autis)'
                            ])
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

    public static function getLabel(): string
    {
        return 'Kelas';
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
