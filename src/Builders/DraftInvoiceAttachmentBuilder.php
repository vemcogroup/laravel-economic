<?php

namespace LasseRafn\Economic\Builders;

use LasseRafn\Economic\Utils\Request;
use LasseRafn\Economic\Models\DraftInvoiceAttachment;

class DraftInvoiceAttachmentBuilder extends Builder
{
    protected $entity = 'invoices/drafts/:draftInvoiceNumber/attachment/file';
    protected $model = DraftInvoiceAttachment::class;

    public $draftInvoiceNumber;

    public function __construct(Request $request, $drafInvoiceNumber)
    {
        $this->draftInvoiceNumber = $drafInvoiceNumber;
        $this->entity = str_replace(':draftInvoiceNumber', $this->draftInvoiceNumber, $this->entity);

        parent::__construct($request);
    }

    public function create($attachmentFile)
    {
        return $this->request->handleWithExceptions(function () use ($attachmentFile) {
            $response = $this->request->doRequest('post', "/{$this->entity}", [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($attachmentFile, 'r'),
                        'filename' => basename($attachmentFile),
                    ]
                ],
            ]);

            $responseData = json_decode($response->getBody()->getContents());

            $response->getBody()->close();

            return new $this->model($this->request, $responseData);
        });
    }
}
