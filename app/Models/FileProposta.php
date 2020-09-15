<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Exception;

class FileProposta extends Model
{
    protected $table = 'tb_file_proposta';

    protected $fillable = [
        'id_proposta',
        'nm_file',
        'type_file'
    ];

    public function CreateFileProposta($file, int $id){

        // Define um nome como Tipo de usuario, ID do usuario atual e ID do documento.
        $name = uniqid(date('HisYmd'));

        // Recupera a extensão do arquivo
        $extension = $file->extension();

        // Define finalmente o nome
        $fileName = "{$name}.{$extension}";

        // Faz o upload:
        $documentoAtual = $file;

        $upload = $documentoAtual->move(public_path('File/Proposta'. '/'. $id. '/'), $fileName);
        if ( !$upload )
        return redirect()->back();

        FileProposta::insert([
            'id_proposta' => $id,
            'nm_file' => $fileName,
            'type_file' => $extension
        ]);

        return true;
    }

    public function UpdateFileProposta($file, int $id){

        //apagar imagem atual
        unlink(public_path('File/Proposta'. '/'. $id. '/'. $file));

        // Define um nome como Tipo de usuario, ID do usuario atual e ID do documento.
        $name = uniqid(date('HisYmd'));

        // Recupera a extensão do arquivo
        $extension = $file->extension();

        // Define finalmente o nome
        $fileName = "{$name}.{$extension}";

        // Faz o upload:
        $documentoAtual = $file;

        $upload = $documentoAtual->move(public_path('File/Proposta'. '/'. $id. '/'), $fileName);
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

        // Verifica se NÃO deu certo o upload (Redireciona de volta)
        if ( !$upload )
            return redirect()->back();
        // Else, se o user nao quiser mudar a foto de perfil
        FileProposta::where('id', $id)->update([
            'nm_file' => $fileName,
            'type_file' => $extension
        ]);

        return true;
    }
}
