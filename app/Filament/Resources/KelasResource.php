<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelasResource\Pages;
use App\Filament\Resources\KelasResource\RelationManagers;
use App\Models\Kelas;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KelasResource extends Resource
{
    protected static ?string $model = Kelas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Kelas Siswa';

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

                        Select::make('tingkat')
                            ->label('Tingkat')
                            ->options([
                                'x' => 'X',
                                'xi' => 'XI',
                                // 'xii' => 'XII'
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
                                'a' => 'A',
                                'b' => 'B',
                                'c' => 'C',
                                'd' => 'D'
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
                    ->icon('heroicon-o-pencil-square')
                    ->iconColor('primary')
                    ->searchable(),

                TextColumn::make('tingkat')
                    ->label('Tingkatan')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->iconColor('primary')
                    ->searchable(),

                TextColumn::make('nama_kelas')
                    ->label('Nama kelas')
                    ->copyable()
                    ->copyMessage('nama kelas berhasil di salin')
                    ->icon('heroicon-o-arrow-right-end-on-rectangle')
                    ->badge()

                    ->searchable(),

                TextColumn::make('kebutuhan')
                    ->label('kebutuhan siswa')
                    ->icon('heroicon-o-cube-transparent')
                    ->iconColor('primary')
                    ->badge()
                    ->searchable(),


            ])
            ->filters([
                SelectFilter::make('tingkat')
                    ->label('Tingkat')
                    ->options([
                        'X' => 'X',
                        'XI' => 'XI',
                        'XII' => 'XII'
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelas::route('/'),
            'create' => Pages\CreateKelas::route('/create'),
            'edit' => Pages\EditKelas::route('/{record}/edit'),
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
