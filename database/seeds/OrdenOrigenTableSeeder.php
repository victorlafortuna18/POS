<?php
 
use Illuminate\Database\Seeder;
use SmartDelivery\OrdenOrigen;
 
// Le indicamos que utilice también Faker.
// Información sobre Faker: https://github.com/fzaninotto/Faker
use Faker\Factory as Faker;
 
class OrdenOrigenTableSeeder extends Seeder {
 
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Creamos una instancia de Faker
		$faker = Faker::create();
 
		// Creamos un bucle para cubrir 5 fabricantes:
		for ($i=0; $i<3; $i++)
		{
			// Cuando llamamos al método create del Modelo Fabricante 
			// se está creando una nueva fila en la tabla.
			OrdenOrigen::create(
				[
					'ordenid'=>$faker->randomNumber(8),
					'tip_iden'=>$faker->text(5),
					'identificacion'=>$faker->randomNumber(8),
					'cliente'=>$faker->name(),
					'telefono'=>$faker->phoneNumber(),
					'mail'=>$faker->email(),
					'sucursalid'=>$faker->randomNumber(2),
					'subtotal'=>$faker->randomDigit,
					'impuesto'=>$faker->randomDigit,
					'total'=>$faker->randomDigit,
					'ciudad'=>$faker->city(),
					'pais'=>$faker->country(),
					'direccion'=>$faker->streetAddress(),
					'estadopedido'=>$faker->word()
				]
			);
		}
 
	}
 
}