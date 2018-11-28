<?php

namespace App\Form\Type\Trick;

use App\Entity\Category;
use App\Entity\Trick;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TrickType
 * @package App\Form\Type\Trick
 */
class TrickType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom :"
            ])
            ->add('description', TextareaType::class,[
                "label" => "Description"
            ])
            ->add('category', EntityType::class, [
                "label" => "Catégorie :",
                "class" => Category::class,
                "choice_label" => "name"
            ])
            ->add("videos", CollectionType::class, [
                "entry_type" => VideoType::class,
                "allow_add" => true,
                "allow_delete" => true,
                "by_reference" => false
            ])
            ->add("images", CollectionType::class, [
                "entry_type" => ImageType::class,
                "allow_add" => true,
                "allow_delete" => true,
                "by_reference" => false
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                /** @var Trick $trick */
                $trick = $event->getData();

                $event->getForm()->add("submit", SubmitType::class, [
                    "label" => $trick->getId() ? "Modifier" : "Ajouter"
                ]);
            })
        ;
    }

    /**
     * @inheritdoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
