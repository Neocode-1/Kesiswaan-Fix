<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Siswa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\SiswaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SiswaResource\RelationManagers;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Data Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Data Siswa')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->completedIcon('heroicon-m-clipboard-document-check')
                        ->schema([
                            Section::make()
                                ->description('Data Personal Siswa')
                                ->schema([
                                    TextInput::make('nama')
                                        ->placeholder('Masukkan Nama Lengkap Siswa')
                                        ->label('Nama Siswa')
                                        ->prefixIcon('heroicon-o-user')
                                        ->prefixIconColor('primary')
                                        ->required()
                                        ->rule('regex:/^[a-zA-Z\s]+$/')
                                        ->validationMessages([
                                            'regex' => 'Nama hanya boleh berisi huruf dan spasi saja, bro!',
                                            'required' => 'Namanya kosong nih tolong isi ya'
                                        ]),
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
                                    TextInput::make('tmpt_lahir')
                                        ->placeholder('Masukkan Tempat Lahir Siswa')
                                        ->label('Tempat Lahir Siswa')
                                        ->prefixIcon('heroicon-o-map-pin')
                                        ->prefixIconColor('primary')
                                        ->required(),
                                    DatePicker::make('tgl_lahir')
                                        ->label('Tanggal Lahir Siswa')
                                        ->placeholder('Masukkan Tanggal Lahir Siswa')
                                        ->prefixIcon('heroicon-o-calendar-days')
                                        ->prefixIconColor('primary')
                                        ->native(false)
                                        ->displayFormat('d/m/Y')
                                        ->required(),
                                    ToggleButtons::make('jenis_kelamin')
                                        ->inline()
                                        ->columnSpanFull()
                                        ->grouped()
                                        ->required()
                                        ->options([
                                            'Laki-laki' => 'Laki-laki',
                                            'Perempuan' => 'Perempuan',
                                        ])
                                        ->icons([
                                            'Laki-laki' => 'heroicon-o-user',
                                            'Perempuan' => 'heroicon-o-user-circle',
                                        ])

                                        ->colors([
                                            'Laki-laki' => 'sky',
                                            'Perempuan' => 'pink',
                                        ]),
                                    ToggleButtons::make('status_pip')
                                        ->inline()
                                        ->columnSpanFull()
                                        ->grouped()
                                        ->required()
                                        ->options([
                                            'Sudah' => 'Sudah',
                                            'Belum' => 'Belum',
                                        ])
                                        ->icons([
                                            'Sudah' => 'heroicon-o-check-circle',
                                            'Belum' => 'heroicon-o-x-circle',
                                        ])

                                        ->colors([
                                            'Sudah' => 'success',
                                            'Belum' => 'danger',
                                        ]),
                                    Select::make('agama')
                                        ->label('Agama Siswa')
                                        ->prefixIcon('heroicon-o-information-circle')
                                        ->prefixIconColor('primary')
                                        ->placeholder('Silahkan pilih yang sesuai')
                                        ->required()
                                        ->options([
                                            'Islam',
                                            'Kristen',
                                            'Katholik',
                                            'Hindu',
                                            'Budha',
                                            'Konghucu'
                                        ]),
                                    TextInput::make('telp_rumah')
                                        ->label('Nomor Telepon Rumah')
                                        ->placeholder('Silahkan Masukkan Nomor Teleponnya')
                                        ->required()
                                        ->numeric()
                                        ->prefixIcon('heroicon-o-phone')
                                        ->prefixIconColor('primary'),
                                    TextInput::make('sekolah_asal')
                                        ->label('Asal Sekolah')
                                        ->placeholder('Silahkan isi asal sekolah sebelumnya')
                                        ->prefixIcon('heroicon-o-building-library')
                                        ->prefixIconColor('primary')
                                        ->required(),
                                    DatePicker::make('tgl_masuk')
                                        ->label('Tanggal Masuk Siswa')
                                        ->placeholder('Masukkan Tanggal Lahir Siswa')
                                        ->prefixIcon('heroicon-o-calendar-days')
                                        ->prefixIconColor('primary')
                                        ->native(false)
                                        ->displayFormat('d/m/Y')
                                        ->required(),
                                    DatePicker::make('tgl_keluar')
                                        ->label('Tanggal Keluar Siswa')
                                        ->placeholder('Masukkan Tanggal Lahir Siswa')
                                        ->prefixIcon('heroicon-o-calendar-days')
                                        ->prefixIconColor('primary')
                                        ->native(false)
                                        ->displayFormat('d/m/Y')
                                        ->required(),
                                    Textarea::make('alamat')
                                        ->placeholder('Silahkan isi alamat lengkapnya disini')
                                        ->label('Alamat Lengkap Siswa')
                                        ->required(),
                                ])
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->icon('heroicon-o-user')
                    ->iconColor('primary')
                    ->description(fn(Siswa $record): string => "" . $record->nisn)
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('nisn', $direction);
                    }),
                TextColumn::make('jenis_kelamin')
                    ->searchable()
                    ->label('Jenis Kelamin')
                    ->icon('heroicon-o-user-circle')
                    ->color(function ($record) {
                        $jenis_kelamin = $record->jenis_kelamin;
                        if ($jenis_kelamin == 'Laki-laki') {
                            return 'sky';
                        } else {
                            return 'pink';
                        }
                    }),
                TextColumn::make('agama'),
                TextColumn::make('status_pip')
                    ->searchable()
                    ->label("Status PIP")
                    ->icon(function ($record) {
                        $status_pip = $record->status_pip;
                        if ($status_pip == 'Sudah') {
                            return 'heroicon-o-check-circle';
                        } else {
                            return 'heroicon-o-x-circle';
                        }
                    })
                    ->color(function ($record) {
                        $status_pip = $record->status_pip;
                        if ($status_pip == 'Sudah') {
                            return 'success';
                        } else {
                            return 'danger';
                        }
                    })
                    ->badge(),
                TextColumn::make('alamat'),
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
