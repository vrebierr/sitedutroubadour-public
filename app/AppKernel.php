<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new SimpleThings\EntityAudit\SimpleThingsEntityAuditBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            new Sonata\CacheBundle\SonataCacheBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\jQueryBundle\SonatajQueryBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Sdt\ForumBundle\SdtForumBundle(),
            new Sdt\NewsBundle\SdtNewsBundle(),
            new Knp\Bundle\TimeBundle\KnpTimeBundle(),
            new Ornicar\MessageBundle\OrnicarMessageBundle(),
            new Sdt\MessageBundle\SdtMessageBundle(),
            new Stfalcon\Bundle\TinymceBundle\StfalconTinymceBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Sdt\TutorialBundle\SdtTutorialBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            new Sdt\ScoreBundle\SdtScoreBundle(),
            new Sdt\AdvertBundle\SdtAdvertBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\CommentBundle\FOSCommentBundle(),
            new Sdt\CommentBundle\SdtCommentBundle(),
            new Sdt\CoreBundle\SdtCoreBundle(),
            new Craue\FormFlowBundle\CraueFormFlowBundle(),
            new Genemu\Bundle\FormBundle\GenemuFormBundle(),
            new Sonata\IntlBundle\SonataIntlBundle(),
            new Exercise\HTMLPurifierBundle\ExerciseHTMLPurifierBundle(),
            new Sdt\SessionBundle\SdtSessionBundle(),
            new JMS\Payment\CoreBundle\JMSPaymentCoreBundle(),
            new JMS\Payment\PaypalBundle\JMSPaymentPaypalBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new Sdt\PaymentBundle\SdtPaymentBundle(),
            new WhiteOctober\BreadcrumbsBundle\WhiteOctoberBreadcrumbsBundle(),
            new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
