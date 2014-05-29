<?php

namespace Sdt\TutorialBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TutorialCommentAdmin extends Admin
{
	protected function configureShowField(ShowMapper $showMapper)
	{
		$showMapper
			->add('news')
			->add('message')
			->add('author')
			->add('createdAt')
			->add('updatedAt')
		;
	}

	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->with('General')
				->add('news', 'sonata_type_model')
				->add('message')
				->add('author', 'sonata_type_model')
			->end()
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('news')
			->add('message')
			->add('author')
			->add('createdAt')
			->add('updatedAt')
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
			->add('news', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
			->add('message')
			->add('author', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
		;
	}
}