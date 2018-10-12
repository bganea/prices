<?php

use Illuminate\Database\Seeder;

use App\Shop;

class ShopsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$shop=new Shop();
		$shop->name='Emag';
		$shop->url='https://www.emag.ro/masina-de-cusut-computerizata-brother-innov-is-55fe-feshion-edition-152-cusaturi-ecran-lcd-10-modele-butoniera-1-pas-iluminare-led-pedala-de-picior-850-imp-min-alb-nv55fevl1/pd/D29BV7BBM/';
		$shop->regex='EM\.productDiscountedPrice = ([\d]+);';
		$shop->save();

		$shop=new Shop();
		$shop->name='PC Garage';
		$shop->url='https://www.pcgarage.ro/ingrijire-tesaturi/brother/innovis-55fe/';
		$shop->regex='"dynx_totalvalue": ([\d]+)';
		$shop->save();

		$shop=new Shop();
		$shop->name='Vexio';
		$shop->url='https://www.vexio.ro/masini-de-cusut/brother/181239-masina-de-cusut-casnica-computerizata-nv55fe/';
		$shop->regex='itemprop="price"[\s]+content="([\d]+)';
		$shop->save();

		$shop=new Shop();
		$shop->name='Cusut & Brodat';
		$shop->url='https://www.cusutsibrodat.ro/masina-de-cusut-brother-innov-is-55.html';
		$shop->regex='"promo":([\d]+)';
		$shop->save();

		$shop=new Shop();
		$shop->name='decusut.ro';
		$shop->url='https://decusut.ro/produs/masina-de-cusut-brother-nv55fe-produs-nou/';
		$shop->regex='"value":([\d]+)';
		$shop->save();

		$shop=new Shop();
		$shop->name='Evomag';
		$shop->url='https://www.evomag.ro/electrocasnice-masini-de-cusut-masini-de-cusut/brother-masina-de-cusut-casnica-brother-innov-is-55fe-computerizata-alba-2933502.html';
		$shop->regex='"value":([\d]+)';
		$shop->save();

		$shop=new Shop();
		$shop->name='Cumperiorice';
		$shop->url='https://www.cumperi-orice.ro/masini-de-cusut/masina-de-cusut-brother-innov-is-55-fashion-edition--135-cusaturi--display-lcd--alb-brother-innov-is-55fe.html';
		$shop->regex='promo\': \'([\d]+)';
		$shop->save();

		$shop=new Shop();
		$shop->name='Magazinieftin';
		$shop->url='https://www.magazinieftin.ro/index.php/catalog/product/view/id/72095/s/masina-de-cusut-brother-innovis-55fe/';
		$shop->regex='\'Price\': \'([\d]+)';
		$shop->save();

		$shop=new Shop();
		$shop->name='Kreativshop';
		$shop->url='https://www.kreativshop.ro/index.php/catalog/product/view/id/27440/s/masina-de-cusut-brother-innov-is-55fe/';
		$shop->regex='"promo":([\d]+)';
		$shop->save();

		$shop=new Shop();
		$shop->name='DOMO';
		$shop->url='http://www.domo.ro/masini-de-cusut/masina-de-cusut-brother-innov_is-55fe-135-tipuri-de-cusaturi-iluminare-led-alb-pMiU6Nj0n-l/';
		$shop->regex='value: \'([\d]+)';
		$shop->save();
	}
}
