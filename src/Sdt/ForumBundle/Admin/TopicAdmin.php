<?php

namespace Sdt\ForumBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TopicAdmin extends Admin
{
	protected function configureShowField(ShowMapper $showMapper)
	{
		$showMapper
			->add('forum')
			->add('subject')
			->add('author')
			->add('isClosed')
			->add('isPinned')
			->add('isBuried')
			->add('numViews')
			->add('numPosts')
			->add('createdAt')
			->add('pulledAt')
		;
	}

	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->with('General')
				->add('forum', 'sonata_type_model')
				->add('subject')
				->add('author', 'sonata_type_model')
			->end()
			->with('Administration')
				->add('isClosed', null, array('required' => false))
				->add('isPinned', null, array('required' => false))
				->add('isBuried', null, array('required' => false))
			->end()
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('subject')
			->add('isClosed', null, array('editable' => true))
			->add('isPinned', null, array('editable' => true))
			->add('isBuried', null, array('editable' => true))
			->add('createdAt')
			->add('pulledAt')
			->add('forum')
			->add('author')
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
			->add('forum', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
			->add('subject')
			->add('author', null, array('field_options' => array('expanded' => true, 'multiple' => true)))
			->add('isClosed')
			->add('isPinned')
			->add('isBuried')
		;
	}
}