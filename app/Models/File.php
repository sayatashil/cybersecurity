<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 * 
 * @property int $id
 * @property string|null $file_id
 * @property string|null $filename
 * @property string|null $filetype
 * @property string|null $data
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class File extends Model
{
	protected $table = 'files';

	protected $fillable = [
		'file_id',
		'filename',
		'filetype',
		'data'
	];
}
