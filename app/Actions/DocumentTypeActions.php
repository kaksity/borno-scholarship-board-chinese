<?php

namespace App\Actions;

use App\Models\DocumentType;
use App\Repositories\Interfaces\DocumentTypeRepositoryInterface;

class DocumentTypeActions
{
    public function __construct(
        private DocumentType $documentType
    )
    {}

    public function createDocumentTypeRecord($data)
    {
        return $this->documentType->create($data);
    }

    public function updateDocumentTypeRecord($data, $id)
    {
        $this->documentType->where([
            'id' => $id
        ])->update($data);
    }

    public function deleteDocumentTypeRecord($id)
    {
        $this->documentType->where([
            'id' => $id
        ])->delete();
    }
    public function getDocumentTypeById($id, $relationships = [])
    {
        return $this->documentType->with($relationships)->where([
            'id' => $id
        ])->first();
    }

    public function listDocumentTypes($relationships = [])
    {
        return $this->documentType->with($relationships)->orderBy('name', 'ASC')->get();
    }
}
