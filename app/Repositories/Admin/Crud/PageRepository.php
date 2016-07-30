<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

namespace App\Repositories\Admin\Crud;

use App\Models\Page;
use App\Repositories\Admin\CrudRepository;

class PageRepository extends CrudRepository
{
	protected function setModel()
	{
		$this->Model = Page::class;
	}

	protected function setSingular()
	{
		$this->singular = "Page";
	}

	protected function setPlural()
	{
		$this->plural = "Pages";
	}

	protected function setHandle()
	{
		$this->handle = "pages";
	}

	protected function setIndexOrder()
	{
		$this->indexOrder = [
			'column'    => 'title',
			'direction' => 'ASC',
		];
	}

	protected function setIndexCols()
	{
		$this->indexCols = [
			'slug',
			'title',
			'updated_at',
		];
	}

	protected function setSearchCols()
	{
		$this->searchCols = [
			'title',
			'slug',
			'plaintext',
		];
	}

	public function getCols()
	{
		return [
			'id' => [
				'pretty' => 'ID',
				'type'   => 'text',
				'attributes' => [
					'disabled',
				],
			],
			'slug' => [
				'pretty'   => 'Slug',
				'type'     => 'text',
				'attributes' => [
					'required',
				],
				'validate' => [
					'required',
					'alpha_dash',
					'unique:pages,slug',
				],
				'logChanges' => true,
			],
			'title' => [
				'pretty' => 'Title',
				'type'   => 'text',
				'attributes' => [
					'required',
				],
				'validate' => [
					'required',
				],
				'logChanges' => true,
			],
			'image' => [
				'pretty'     => 'Image',
				'type'       => 'image',
				'attributes' => [],
				'logChanges' => true,
			],
			'og_desc' => [
				'pretty'     => 'OG Description',
				'type'       => 'text',
				'attributes' => [],
				'validate' => [
					'max:300',
				],
				'logChanges' => true,
			],
			'html' => [
				'pretty'     => 'Content',
				'type'       => 'wysiwyg',
				'attributes' => [],
				'logChanges' => true,
			],
			'updated_at' => [
				'pretty'     => 'Updated At',
				'type'       => 'text',
				'attributes' => [
					'disabled',
				],
			],
			'created_at' => [
				'pretty'     => 'Created At',
				'type'       => 'text',
				'attributes' => [
					'disabled',
				],
			],
		];
	}
}