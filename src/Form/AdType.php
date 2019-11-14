<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdType extends AbstractType
{
    /**
     * permet d'avoir la configuration
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    private function getConfiguration($label, $placeholder, $options = []) {
        return array_merge([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
                ]
            ], $options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                 TextType::class,
                  $this->getConfiguration("Titre", "Tapez un titre pour votre annonce")
                  )
            ->add(
                'slug',
                 TextType::class,
                  $this->getConfiguration("Adresse web", "Tapez l'adresse web de votre annonce (automatique)", [
                      'required' => false
                  ])
                  )
            ->add(
                'coverImage',
                 UrlType::class,
                  $this->getConfiguration("URL de l'image principale", "Télechargez les photo de votre appartement" )
                  )
            ->add(
                'introduction',
                 TextType::class,
                  $this->getConfiguration("Introduction", "Donnez une description de l'annonce")
                  )
            ->add(
                'content',
                 TextareaType::class,
                 $this->getConfiguration("Description détaillée", "Tapez une description qui donne vraiment envie de venir chez vous")
                 )
            ->add(
                'rooms',
                 IntegerType::class, 
                 $this->getConfiguration("Nombre de chambres", "Indiquez le nombre de chambres de votre appartement")
                 )
            ->add(
                'price',
                 MoneyType::class, 
                 $this->getConfiguration("Prix par nuit", "Indiquez le prix par nuit")
                 )
            ->add(
                'images',
                 CollectionType::class,
                 [
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                 ]
                 )
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class
        ]);
    }
}
