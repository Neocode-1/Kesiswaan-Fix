<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Siswa;
use App\Models\Prestasi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PrestasiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PrestasiResource\RelationManagers;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->description('Data Prestasi Siswa')
                    ->schema([
                        Select::make('siswa_id')
                            ->label('Nama Siswa')
                            ->preload()
                            ->prefixIcon('heroicon-o-user')
                            ->prefixIconColor('primary')
                            ->relationship('siswa', 'nama')
                            ->placeholder('Masukkan Nama Siswa')
                    ]),
                TextInput::make('nama_prestasi')
                    ->label('Nama Lomba')
                    ->placeholder('Masukkan Nama Prestasi Anda')
                    ->prefixIcon('heroicon-o-academic-cap')
                    ->prefixIconColor('primary'),
                Select::make('tingkat')
                    ->label('Tingkat Perlombaan')
                    ->placeholder('Silahkan pilih yang sesuai')
                    ->required()
                    ->prefixIcon('heroicon-o-academic-cap')
                    ->prefixIconColor('primary')
                    ->options([
                        'Sekolah' => 'Sekolah',
                        'Kelurahan' => 'Kelurahan',
                        'Kecamatan' => 'Kecamatan',
                        'Kabupaten' => 'Kabupaten',
                        'Provinsi' => 'Provinsi',
                        'Nasional' => 'Nasional',
                        'Internasional' => 'Internasional',
                    ]),
                FileUpload::make('foto_upload')
                    ->label('Upload Dokumentasi'),
                TextInput::make('tahun')
                    ->label('Tahun Prestasi')
                    ->prefixIcon('heroicon-o-chart-bar')
                    ->prefixIconColor('primary')
                    ->placeholder('Silahkan pilih yang sesuai')
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
                    ->iconColor('primary')
                    ->description(fn(Siswa $record): string => "" . $record->nisn)
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('nisn', $direction);
                    }),
                TextColumn::make('nama_prestasi')
                    ->label('Nama Lomba')
                    ->searchable()
                    ->icon('heroicon-o-star')
                    ->iconColor('primary'),
                TextColumn::make('tingkat')
                    ->label('Tingkat Perlombaan')
                    ->searchable()
                    ->icon('heroicon-o-information-circle')
                    ->iconColor('primary'),
                TextColumn::make('tahun')
                    ->label('Tahun Perlombaan')
                    ->searchable()
                    ->icon('heroicon-o-calendar-days')
                    ->iconColor('primary'),
                ImageColumn::make('foto_upload')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPrestasis::route('/'),
            'create' => Pages\CreatePrestasi::route('/create'),
            'edit' => Pages\EditPrestasi::route('/{record}/edit'),
        ];
    }
}
