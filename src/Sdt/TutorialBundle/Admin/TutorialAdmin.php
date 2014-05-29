<?php

namespace Sdt\TutorialBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TutorialAdmin extends Admin
{
	protected function configureShowField(ShowMapper $showMapper)
	{
		$showMapper
			->add('title')
			->add('category')
			->add('content')
			->add('author')
			->add('status')
		;
	}

	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->with('General')
				->add('title')
				->add('media', 'sonata_type_model')
				->add('category', 'sonata_type_model', array('required' => false))
				->add('content', 'genemu_tinymce', array('attr' => array('class' => 'tinymce')))
				->add('author', 'sonata_type_model')
				->add('status')
			->end()
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('title')
			->add('category')
			->add('requested')
			->add('author')
			->add('status')
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
			->add('title')
			->add('category')
			->add('content')
			->add('author', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
			->add('status')
		;
	}
}