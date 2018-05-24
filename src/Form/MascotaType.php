<?php
namespace App\Form;
use App\Entity\Mascota;
use App\Entity\Cliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class MascotaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('animal')
            ->add('fechanac')
            ->add('cliente',EntityType::class,array(
                'class' => Cliente::class,
                'choice_label' => 'nombre' 
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mascota::class,
        ]);
    }
}