<?php

namespace App\Form;


use App\Entity\Producto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Categoria;



class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, array(
             'required' => true,
             'empty_data' => 'Nombre',
             'attr' => array(
                'class'=> 'campos'
            )
        ))

            ->add('nombre')
            ->add('precio')
            ->add('categoria',EntityType::class,array(

                'class' => Categoria::class,

                'choice_label' => function ($categoria) {

                    return $categoria->getNombre();

            }))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success'),

        ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
        ]);
    }
}
