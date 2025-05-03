<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RaportResource\Pages;
use App\Filament\Resources\RaportResource\RelationManagers;
use App\Models\Raport;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RaportResource extends Resource
{
    protected static ?string $model = Raport::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-up';

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
                        ->description('Data lengkap siswa')
                        ->schema([
                            TextInput::make('Nama siswa')
                            ->placeholder('Masukan nama lengkap siswa')
                            ->label('Nama Siswa')
                            ->prefixIcon('heroicon-o-user')
                            ->prefixIconColor('primary')
                            ->required()
                            ->rule('regex:/^[a-zA-Z\s]+$/')
                            ->validationMessages([
                                'regex' => 'Nama hanya boleh berisi huruf dan spasi saja, bro!',
                                'required' => 'Namanya kosong nih tolong isi ya'
                            ]),

                            FileUpload::make('upload_file')
                            ->placeholder('Masukan file nilai')
                            ->label('file nilai')
                            ->required(),

                            Textarea::make('catatan')
                            ->label('catatan siswa'),
                            
                            
                        ])
                    ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('siswa')
                ->label('Nama Siswa')
                ->icon('heroicon-o-user')
                ->iconColor('primary')
                ->iconColor('primary'),

                TextColumn::make('upload_file')
                ->label('file raport')
                ->iconColor('primary')
                ->Icon('heroicon-o-document-check'),

                TextColumn::make('catatan')
                ->label('Catatan Siswa')
                ->iconColor('primary')
                ->icon('heroicon-o-clipboard-document-list')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListRaports::route('/'),
            'create' => Pages\CreateRaport::route('/create'),
            'edit' => Pages\EditRaport::route('/{record}/edit'),
        ];
    }
}
