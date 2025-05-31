<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Panel;
use Filament\Tables;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Prestasi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Klasifikasi;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\SiswaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SiswaResource\RelationManagers;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;
    protected static ?int $navigationSort = 1;
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
                                        ->validationMessages([
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
                                            'Islam' => 'Islam',
                                            'Kristen' => 'Kristen',
                                            'Katholik' => 'Katholik',
                                            'Hindu' => 'Hindu',
                                            'Budha' => 'Budha',
                                            'Konghucu' => 'Konghucu',
                                        ]),
                                    TextInput::make('telp_rumah')
                                        ->label('Nomor Telepon Rumah')
                                        ->placeholder('Silahkan Masukkan Nomor Teleponnya')
                                        ->required()
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
                                        ->placeholder('Masukkan Tanggal Masuk Siswa')
                                        ->prefixIcon('heroicon-o-calendar-days')
                                        ->prefixIconColor('primary')
                                        ->native(false)
                                        ->displayFormat('d/m/Y')
                                        ->required(),
                                    DatePicker::make('tgl_keluar')
                                        ->label('Tanggal Keluar Siswa')
                                        ->placeholder('Masukkan Tanggal Keluar Siswa')
                                        ->prefixIcon('heroicon-o-calendar-days')
                                        ->prefixIconColor('primary')
                                        ->native(false)
                                        ->displayFormat('d/m/Y')
                                        ->required(),
                                    Select::make('tahun_ajaran')
                                        ->label('Tanggal Keluar Siswa')
                                        ->placeholder('Masukkan Tahun Ajaran Siswa')
                                        ->prefixIcon('heroicon-o-calendar-days')
                                        ->prefixIconColor('primary')
                                        ->required()
                                        ->options([
                                            2022,
                                            2023,
                                            2024,
                                            2025,
                                            2026,
                                            2027
                                        ]),
                                    Textarea::make('alamat')
                                        ->placeholder('Silahkan isi alamat lengkapnya disini')
                                        ->label('Alamat Lengkap Siswa')
                                        ->required(),
                                ])
                        ]),
                    Wizard\Step::make('Data Ortu Santri')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->completedIcon('heroicon-m-clipboard-document-check')
                        ->schema([
                            Grid::make()
                                ->relationship('family')
                                ->schema([
                                    Section::make()
                                        ->description("Data Keluarga Siswa")
                                        ->schema([
                                            Select::make('status_keluarga')
                                                ->label('Status Keluarga Siswa')
                                                ->prefixIcon('heroicon-o-information-circle')
                                                ->prefixIconColor('primary')
                                                ->placeholder('Silahkan pilih yang sesuai')
                                                ->required()
                                                ->options([
                                                    'Kandung' => 'Kandung',
                                                    'Tiri' => 'Tiri',
                                                    'Angkat' => 'Angkat',
                                                ]),
                                            TextInput::make('anak_ke')
                                                ->label('Anak Ke-')
                                                ->placeholder('Silahkan isi data anak ke-')
                                                ->prefixIcon('heroicon-o-identification')
                                                ->prefixIconColor('primary')
                                                ->numeric()
                                                ->required(),
                                            TextInput::make('jml_sdr')
                                                ->label('Dari')
                                                ->placeholder('Silahkan isi data jumlah saudara')
                                                ->prefixIcon('heroicon-o-identification')
                                                ->prefixIconColor('primary')
                                                ->numeric()
                                                ->required(),
                                            Textarea::make('alamat_ortu')
                                                ->label('Alamat Orang Tua')
                                                ->placeholder('Silahkan diisi')
                                                ->required(),
                                        ]),
                                    Section::make()
                                        ->description('Biodata Ayah')
                                        ->schema([
                                            TextInput::make('nama_ayah')
                                                ->label('Nama Ayah')
                                                ->placeholder('Silahkan diisi')
                                                ->prefixIcon('heroicon-o-user')
                                                ->prefixIconColor('primary')
                                                ->required(),
                                            TextInput::make('no_telp_ayah')
                                                ->label('Nomor Telpon Ayah')
                                                ->placeholder('Silahkan diisi')
                                                ->prefixIcon('heroicon-o-phone')
                                                ->prefixIconColor('primary')
                                                ->required(),
                                            TextInput::make('pekerjaan_ayah')
                                                ->label('Pekerjaan Ayah')
                                                ->placeholder('Silahkan diisi')
                                                ->prefixIcon('heroicon-o-briefcase')
                                                ->prefixIconColor('primary')
                                                ->required(),
                                        ]),
                                    Section::make()
                                        ->description('Biodata Ibu')
                                        ->schema([
                                            TextInput::make('nama_ibu')
                                                ->label('Nama Ibu')
                                                ->placeholder('Silahkan diisi')
                                                ->prefixIcon('heroicon-o-user')
                                                ->prefixIconColor('primary')
                                                ->required(),
                                            TextInput::make('no_telp_ibu')
                                                ->label('Nomor Telpon Ibu')
                                                ->placeholder('Silahkan diisi')
                                                ->prefixIcon('heroicon-o-phone')
                                                ->prefixIconColor('primary')
                                                ->required(),
                                            TextInput::make('pekerjaan_ibu')
                                                ->label('Pekerjaan Ibu')
                                                ->placeholder('Silahkan diisi')
                                                ->prefixIcon('heroicon-o-briefcase')
                                                ->prefixIconColor('primary')
                                                ->required(),
                                        ]),
                                    Section::make()
                                        ->description('Biodata Wali')
                                        ->schema([
                                            TextInput::make('nama_wali')
                                                ->label('Nama Wali')
                                                ->placeholder('Silahkan diisi')
                                                ->prefixIcon('heroicon-o-user')
                                                ->prefixIconColor('primary'),
                                            TextInput::make('no_telp_wali')
                                                ->label('Nomor Telpon Wali')
                                                ->placeholder('Silahkan diisi')
                                                ->prefixIcon('heroicon-o-phone')
                                                ->prefixIconColor('primary'),
                                            TextInput::make('pekerjaan_wali')
                                                ->label('Pekerjaan Wali')
                                                ->placeholder('Silahkan diisi')
                                                ->prefixIcon('heroicon-o-briefcase')
                                                ->prefixIconColor('primary'),
                                            Textarea::make('alamat_wali')
                                                ->label('Alamat Wali')
                                                ->placeholder('Silahkan diisi')
                                        ])
                                ])
                        ]),
                    Wizard\Step::make('Data Prestasi Santri')
                        ->icon('heroicon-o-clipboard-document-list')
                        ->completedIcon('heroicon-m-clipboard-document-check')
                        ->schema([
                            Repeater::make('siswa_id')
                                ->relationship('prestasis')
                                ->label('Data Prestasi')
                                ->schema([
                                    TextInput::make('nama_prestasi')
                                        ->label('Nama Prestasi/Kompetisi/Lomba')
                                        ->prefixIcon('heroicon-o-trophy')
                                        ->prefixIconColor('primary'),
                                    Select::make('tingkat')
                                        ->label('Tingkat Perlombaan')
                                        ->prefixIcon('heroicon-o-chart-bar')
                                        ->prefixIconColor('primary')
                                        ->placeholder('Silahkan pilih yang sesuai')
                                        ->required()
                                        ->options(Prestasi::all()->pluck('tingkat', 'id')
                                            ->unique()),
                                    FileUpload::make('siswa_id')
                                        ->label('Upload Dokumentasi'),
                                    TextInput::make('tahun')
                                        ->label('Tahun Prestasi')
                                        ->prefixIcon('heroicon-o-chart-bar')
                                        ->prefixIconColor('primary')
                                        ->placeholder('Silahkan pilih yang sesuai')

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
                    ->sortable(),
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
                TextColumn::make('kelas.nama_kelas')
                    ->iconColor('primary')
                    ->icon('heroicon-o-academic-cap')
                    ->sortable()
                    ->searchable()
                    ->description(fn(Siswa $record): string => "" . $record->kelas->tingkat)
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            $id = Kelas::where('nama_kelas', 'like', '%' . $search . '%')->first()->id ?? null;
                            if ($id) {
                                return $query->where('kelas_id', 'like', '%' . $id . '%');
                            }
                            return $query;
                        }
                    ),
                // TextColumn::make('klasifikasi.tahun_masuk')
                //     ->iconColor('primary')
                //     ->icon('heroicon-o-calendar')
                //     ->searchable(
                //         query: function (Builder $query, string $search): Builder {
                //             $id = Klasifikasi::where('tahun_masuk', 'like', '%' . $search . '%')->first()->id ?? null;
                //             if ($id) {
                //                 return $query->where('klasifikasi_id', 'like', '%' . $id . '%');
                //             }
                //             return $query;
                //         }
                //     ),
                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->iconColor('primary')
                    ->icon('heroicon-o-map-pin'),
            ])
            ->filters([
                SelectFilter::make('jenis_kelamin')
                    ->label("Jenis Kelamin")
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan'
                    ]),
                SelectFilter::make('agama')
                    ->label("Agama")
                    ->options([
                        'Islam' => 'Islam',
                        'Kristen' => 'Kristen',
                        'Katholik' => 'Katholik',
                        'Hindu' => 'Hindu',
                        'Budha' => 'Budha',
                        'Konghucu' => 'Konghucu',
                    ]),
                SelectFilter::make('status_pip')
                    ->label("Status PIP")
                    ->options([
                        'Sudah' => 'Sudah',
                        'Belum' => 'Belum'
                    ]),

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

    public static function getNavigationBadge(): ?string
    {
        $siswaData = Siswa::all()->count();
        $stringCount = strval($siswaData);
        return $stringCount;
    }
    protected static ?string $navigationBadgeTooltip = 'Total Siswa';


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
