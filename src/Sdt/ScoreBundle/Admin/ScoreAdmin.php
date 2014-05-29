<?php

namespace Sdt\ScoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ScoreAdmin extends Admin
{
	protected function configureShowField(ShowMapper $showMapper)
	{
		$showMapper
			->add('artist')
			->add('song')
			->add('category')
			->add('media')
			->add('uploader')
			->add('enabled')
			->add('createdAt')
			->add('updatedAt')
		;
	}

	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->with('General')
				->add('artist')
				->add('song')
				->add('category', 'sonata_type_model')
				->add('media', 'sonata_type_model')
				->add('uploader', 'sonata_type_model')
				->add('enabled', null, array('required' => false))
			->end()
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('song')
			->add('artist')
			->add('category')
			->add('media')
			->add('uploader')
			->add('enabled')
			->add('_action', 'actions', array(
				'actions' => array(
					'view' => array(),
					'edit' => array(),
					'delete' => array(),
				)
			))
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('artist')
			->add('song')
			->add('category', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
			->add('media', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
			->add('uploader', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
			->add('enabled')
		;
	}
}