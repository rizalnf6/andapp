<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Villa;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\Alignment;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\VillaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VillaResource\RelationManagers;

class VillaResource extends Resource
{
    protected static ?string $model = Villa::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function shouldRegisterNavigation(): bool {
        if (auth()->user()->roles == 'ADMIN') {
            return true;
        } else {
            return false;
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('namaVilla')
                ->label('Villa Name')
                ->required(),
                Section::make('Owner Details')
                    ->schema([
                        TextInput::make('namaOwner')
                        ->label('Owner Name')
                        ->required(),
                        Textarea::make('alamatOwner')
                        ->label('Owner Address'),
                        TextInput::make('contactOwner')
                        ->label('Owner Contact'),
                        TextInput::make('passportDetails')
                        ->label('Passport Details'),
                        FileUpload::make('passportPhoto')
                        ->label('Passport Photo')
                        ->multiple()
                        ->downloadable()
                        ->preserveFilenames(),
                    ])
                    ->columns(2),
                Section::make('Villa Details')
                    ->schema([
                        Textarea::make('alamatVilla')
                        ->label('Villa Adress')
                        ->required(),
                        TextInput::make('buildingSize')
                        ->label('Building Size'),
                        TextInput::make('landSize')
                        ->label('Land Size'),
                        TextInput::make('namaPemilikTanah')
                        ->label('Land Owner Name'),
                        TextInput::make('sertifTanah')
                        ->label('Land Certificate Number'),
                        TextInput::make('imbPbg')
                        ->label('IMB (PBG)'),
                        TextInput::make('lisensi')
                        ->label('Licenses'),
                        DatePicker::make('tglsewaTanah')
                        ->label('Lease Dates'),
                    ])
                    ->columns(2),
                Section::make('Tax')
                    ->schema([
                        TextInput::make('pbTax')
                        ->label('PB1'),
                        Select::make('registeredPe')
                        ->label('Registered as PE')
                        ->options([
                            'Yes' => 'Yes',
                            'No' => 'No'
                        ]),
                        TextInput::make('landbuildStatus')
                        ->label('Land & Build Tax (Status)'),
                        TextInput::make('ossStatus'),
                    ])
                    ->columns(1),
                Section::make('Management Agreement')
                    ->schema([
                        Select::make('signedCopy')
                        ->label('Signed Copy')
                        ->options([
                            'Yes' => 'Yes',
                            'No' => 'No'
                        ]),
                        TextInput::make('bookingCommision')
                        ->label('Booking Commision'),
                        Select::make('fixMonthlyFee')
                        ->label('Fix Monthly Fee')
                        ->options([
                            'Yes' => 'Yes',
                            'No' => 'No'
                        ]),
                        TextInput::make('agentFee')
                        ->label('Managing Agent Fee'),
                        TextInput::make('otherCommision')
                        ->label('Other Commision'),
                        FileUpload::make('managementAgreement')
                        ->label('Agreement Documents')
                        ->multiple()
                        ->downloadable()
                        ->preserveFilenames(),
                    ])
                    ->columns(2),
                
                Section::make('Insurance')
                    ->schema([
                        TextInput::make('perusahaanAsuransi')
                        ->label('Insurance Company'),
                        TextInput::make('noKebijakan')
                        ->label('Policy No.'),
                        TextInput::make('namaAsuransi')
                        ->label('Named Insured'),
                        TextInput::make('totalAsuransi')
                        ->label('Sum Insured'),
                        DatePicker::make('tglPembaharuanAsuransi')
                        ->label('Renewal Date'),
                    ])
                    ->columns(2),
                Section::make('Consultants')
                    ->schema([
                        TextInput::make('consultantUsed')
                        ->label('Consultants Used'),
                        FileUpload::make('listDocuments')
                        ->label('List of Document on File')
                        ->multiple()
                        ->downloadable()
                        ->preserveFilenames(),
                    ])
                    ->columns(2),
            ])
            ->columns(1);
                            
                // TextInput::make('totalKebijakan')
                // ->label('Policy Cost')
                // ->required(),
                // ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                //     return (string) str($file->getClientOriginalName())->prepend(now()->timestamps);
                // }),
                // TextInput::make('tax')
                // ->required(),
                // TextInput::make('registered')
                // ->required(),
                // TextInput::make('outstandingMatters')
                // ->required(),
                // TextInput::make('forSale')
                // ->required()
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->label('No. ')
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('namaVilla')
                ->label('Villa Name')
                ->toggleable(true)
                ->searchable()
                ->alignment(Alignment::Center),
                TextColumn::make('namaOwner')
                ->label('Owner Name')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('alamatOwner')
                ->label('Owner Adress')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('contactOwner')
                ->label('Owner Contact')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('passportDetails')
                ->label('Passport Details')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('passportPhoto')
                ->label('Passport Photo')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('alamatVilla')
                ->label('Villa Adress')
                ->searchable()
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('namaPemilikTanah')
                ->label('Land Owner Name')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('sertifTanah')
                ->label('Land Certificate Number')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('imbPbg')
                ->label('IMB (PBG)')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('lisensi')
                ->label('Licenses')
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('tglsewaTanah')
                ->label('Lease Dates')
                ->date()
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('pbTax')
                ->label('PB1')
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('registeredPe')
                ->label('Registered as PE')
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('landbuildStatus')
                ->label('Land & Build Tax (Status)')
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('ossStatus')
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('signedCopy')
                ->label('Signed Copy')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('bookingCommision')
                ->label('Booking Commision')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('fixMonthlyFee')
                ->label('Fix Monthly Fee')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('agentFee')
                ->label('Agent Fee')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('otherCommision')
                ->label('Other Commision')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('managementAgreement')
                ->label('Other Commision')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('perusahaanAsuransi')
                ->label('Insurance Company')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('noKebijakan')
                ->label('Policy Number')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('namaAsuransi')
                ->label('Named Insured')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('totalAsuransi')
                ->label('Sum Insured')
                ->alignment(Alignment::Center)
                ->toggleable(true),
                TextColumn::make('tglPembaharuanAsuransi')
                ->label('Renewal Date')
                    ->date()
                    ->alignment(Alignment::Center)
                    ->toggleable(true),
                TextColumn::make('consultantUsed')
                ->label('Consultants Used')
                ->toggleable(true)
                ->alignment(Alignment::Center)
                ->searchable(),
                TextColumn::make('listDocuments')
                ->label('List of Document on File')
                ->alignment(Alignment::Center)
                ->searchable()
                ->toggleable(true)

                // TextColumn::make('totalKebijakan')
                // ->label('Policy Cost')
                // ->alignment(Alignment::Center)
                // ->toggleable(true),
                // TextColumn::make('tax')
                // ->alignment(Alignment::Center)
                // ->toggleable(true),
                // TextColumn::make('registered')
                // ->alignment(Alignment::Center)
                // ->toggleable(true),
                // TextColumn::make('outstandingMatters')
                // ->alignment(Alignment::Center)
                // ->toggleable(true),
                // TextColumn::make('forSale')
                // ->alignment(Alignment::Center)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // public static function infolist(Infolist $infolist): Infolist
    // {
    // return $infolist
    //     ->schema([
    //         TextEntry::make('namaVilla'),
    //     ]);
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVillas::route('/'),
            'create' => Pages\CreateVilla::route('/create'),
            'edit' => Pages\EditVilla::route('/{record}/edit'),
            'view' => Pages\ViewVilla::route('/{record}/'),
        ];
    }
}
