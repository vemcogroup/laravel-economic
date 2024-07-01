<?php

namespace LasseRafn\Economic\Models;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use LasseRafn\Economic\Exceptions\EconomicClientException;
use LasseRafn\Economic\Exceptions\EconomicRequestException;
use LasseRafn\Economic\Utils\Model;

class DraftInvoiceAttachment extends Model
{
	protected $entity     = 'invoices/drafts/:draftInvoiceNumber/attachment/file';
	protected $primaryKey = 'draftInvoiceNumber';
}
