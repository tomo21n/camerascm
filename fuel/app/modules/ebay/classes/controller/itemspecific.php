<?php
namespace Ebay;
class Controller_Itemspecific extends \Controller_User
{

    public static $category_list = array(
        3323 => array(array('UPC'=>array('Does not apply')),
                        array('Country/Region of Manufacture' => array('Japan')),
                        array('Focal Length Type'=>array('Fixed/Prime','Zoom')),
                        array('Focal Length'=>array('28mm','35mm','45mm','50mm','55mm','105mm','135mm','200mm' )),
                        array('Camera Type'=>array('SLR','Camcorder','Large Format','Medium Format','Mirrorless','Point and Shoot','Rangefinder','Digital SLR','Other Format')),
                        array('Focus Type'=>array('Manual','Auto','Auto & Manual','Fixed')),
                        array('Maximum Aperture'=>array('f/1.2','f/1.4','f/1.8','f/2','f/2.4','f/2.8','f/4','f/4.5')),
                        array('Type'=>array('Fisheye','Image Stabilization','Macro/Close Up','Perspective Control','Standard','Teleconverter','Telephoto','Wide Angle','Soft Focus','Aspheric','Ultra wide angle','High Quality','Lens Extender','Micro','Portrait','3D Prime','Pinhole','Special Effects')),
                        array('Brand'=>array('Canon','Contax','Fuji','Hasselblad','Konica','Leica','Mamiya','Minolta','Nikon','Olympus','Pentax','Sigma','Tokina','ZenzaBronica')),
                        array('Series'=>''),
                        array('Model'=>''),
                        array('Compatible Brand'=>array('For Bronica','For Canon','For Contax/Yashica','For Exakta','For Fujifilm','For Hasselblad','For Horseman','For JVC','For Kodak','For Konica Minolta','For Leica','For Lomo','For Mamiya','For Minolta','For Nikon','For Olympus','For Panasonic','For Pentax','For Praktica','For Sony','For Voigtlander','For Zeiss','For Zenit',))
                        ),
        15230  => array(array('UPC'=>array('Does not apply')),
                        array('Country/Region of Manufacture' =>array('Japan')),
                        array('Focus Type'=>array('Manual','Auto','Auto & Manual','Fixed')),
                        array('Type'=>array('SLR','TLR','Half Frame','Large Format','Medium Format','Rangefinder')),
                        array('Film Format'=>array('35mm','6x7cm')),
                        array('Brand'=>array('Canon','Contax','Fuji','Hasselblad','Konica','Leica','Mamiya','Minolta','Nikon','Olympus','Sigma','Tokina','ZenzaBronica')),
                        array('Model'=>''),
                        array('Features'=>array('Built-in Flash','Date Imprint','Dioptric Adjustment','Manual Program Modes','Panorama Setting','Red Eye Reduction','Shooting-Modes','Timer','Waterproof/Underwater',))
        ),
        30059  => array(array('UPC'=>array('Does not apply')),
            array('Brand'=>array('Canon','Contax','Fuji','Hasselblad','Konica','Leica','Mamiya','Minolta','Nikon','Olympus','Pentax','Sigma','Tokina','ZenzaBronica')),
            array('Country/Region of Manufacture' =>array('Japan')),
            array('Type'=>array('Lens Adapters','Lens Reversing Adapters','Extension Tubes')),
            array('To Fit'=>array('Camcorder','Camera')),
            array('Camera/Camcorder Fitting'=>array('C-Mount','Canon EOS','Canon FD','Canon FL','Four Thirds','Hasselblad H','Hasselblad V','Leica M','Leica R','M42/Universal','Mamiya 645','Micro Four Thirds','Minolta MD/MC/SR','Nikon F','Nikon S','Olympus OM','Pentax 645','Pentax K/PK','Samsung NX','Sigma SA','Sony Alpha/Minolta AF','Sony E','T-Mount')),
            array('Lens Fitting'=>array('C-Mount','Canon EOS','Canon FD','Canon FL','Four Thirds','Hasselblad H','Hasselblad V','Leica M','Leica R','M42/Universal','Mamiya 645','Micro Four Thirds','Minolta MD/MC/SR','Nikon F','Nikon S','Olympus OM','Pentax 645','Pentax K/PK','Samsung NX','Sigma SA','Sony Alpha/Minolta AF','Sony E','T-Mount'))
        ),
        29973  => array(
            array('Brand'=>array('Canon','Contax','Fuji','Hasselblad','Konica','Leica','Mamiya','Minolta','Nikon','Olympus','Pentax','Sigma','Tokina','ZenzaBronica')),
            array('Type'=>array('Cut Film Holders','Dark Slide Sheet Holders','Film Holder Adapters','Instant Film Backs','Multi-Sheet Holders/Magazines','Preloaded Film Holders','Roll Film Backs')),
            array('Compatible Brand'=>array('For Bronica','For Hasselblad','For Holga','For Horseman','For Leica','For Lomography','For Mamiya','For Minolta','For Nikon','For Pentax')),
            array('Camera Type'=>array('Large Format','Medium Format')),
            array('Camera Size'=>array('24x36mm','70mm','6x4.5cm','6x6cm','6x7cm','6x9cm','4x5in.')),
            array('Country/Region of Manufacture' =>array('Japan')),
            array('Model'=>array()),
        ),
        64345  => array(
            array('Type'=>array('Remote Controls','Shutter Releases')),
            array('Brand'=>array('Canon','Contax','Fuji','Hasselblad','Konica','Leica','Mamiya','Minolta','Nikon','Olympus','Pentax','Sigma','Tokina','ZenzaBronica')),
            array('Compatible Brand'=>array('For Bronica','For Hasselblad','For Holga','For Horseman','For Leica','For Lomography','For Mamiya','For Minolta','For Nikon','For Pentax')),
            array('To Fit'=>array('Camcorder','Camera')),
            array('Connectivity'=>array('Cable','Wireless')),
            array('Country/Region of Manufacture' =>array('Japan')),
            array('Model'=>array()),
        ),
        162480  => array(
            array('Country/Region of Manufacture' =>array('Japan')),
            array('Brand'=>array('Canon','Contax','Fuji','Hasselblad','Konica','Leica','Mamiya','Minolta','Nikon','Olympus','Pentax','Sigma','Tokina','ZenzaBronica')),
            array('Compatible Brand'=>array('For Bronica','For Hasselblad','For Holga','For Horseman','For Leica','For Lomography','For Mamiya','For Minolta','For Nikon','For Pentax')),
            array('To Fit'=>array('Camcorder','Camera')),
            array('Model'=>array()),
        ),

        167930 => array(
            array('Country/Region of Manufacture' =>array('Japan')),
            array('Type'=>array('Eyecups','Viewfinders')),
            array('Camera Type'=>array('Film SLR','Large Format','Medium Format','Rangefinder','Digital SLR')),
            array('Brand'=>array('Canon','Contax','Fuji','Hasselblad','Konica','Leica','Mamiya','Minolta','Nikon','Olympus','Pentax','Sigma','Tokina','ZenzaBronica')),
            array('Compatible Brand'=>array('For Bronica','For Hasselblad','For Holga','For Horseman','For Leica','For Lomography','For Mamiya','For Minolta','For Nikon','For Pentax')),
            array('To Fit'=>array('Camcorder','Camera')),
            array('Model'=>array()),
        ),

    );

	public function action_index()
	{
        $user_info = \Auth::get_user_id();
        $where_array = array();
        $condition = array('where'=> $where_array);
        $data['count'] = Model_Itemspecific::query($condition)->count();
        //Paginationの環境設定
        $config = array(
            'name' => 'pagination',
            'pagination_url' => \Uri::base().'ebay/itemspecific/',
            'uri_segment' => 'page',
            'num_links' => 5,
            'per_page' => 50,
            'total_items' => $data['count'],
        );
        //Paginationのセット
        $pagination = \Pagination::forge('pagination', $config);
        $condition += array('limit' => $pagination->per_page);
        $condition += array('offset' => $pagination->offset);
        $data['itemspecific'] = Model_Itemspecific::find('all',$condition);
        $data['pagination'] = $pagination;

		$this->template->title = "Itemspecific";
		$this->template->content = \View::forge('itemspecific/index', $data);

	}

	public function action_view($itemspecific_id = null)
	{
		is_null($itemspecific_id) and \Response::redirect('itemspecific');

		if ( ! $data['itemspecific'] = Model_Itemspecific::find($itemspecific_id))
		{
			\Session::set_flash('error', 'Could not find itemspecific #'.$itemspecific_id);
			\Response::redirect('ebay/itemspecific');
		}

		$this->template->title = "Itemspecific";
		$this->template->content = \View::forge('itemspecific/view', $data);

	}

	public function action_create()
	{
		if (\Input::method() == 'POST')
		{
			$val = Model_Itemspecific::validate('create');

			if ($val->run())
			{
                $user_info = \Auth::get_user_id();
                $sp_name = \Input::post('name');
                $sp_value = \Input::post('value');

                foreach($sp_name as $key=>$value){
                    $itemspecific = Model_Itemspecific::forge(array(
                        'user_id' => $user_info[1],
                        'specific_id' => \Input::post('specific_id'),
                        'product_id' => \Input::post('product_id'),
                        'product_name' => \Input::post('product_name'),
                        'name' => $sp_name[$key],
                        'value' => $sp_value[$key],
                    ));

                    if (!$itemspecific or !$itemspecific->save()){
                        \Session::set_flash('error', 'Could not save itemspecific.');
                        \Response::redirect('ebay/itemspecific');

                    }


                }
                \Session::set_flash('success', 'Created itemspecific ');
                \Response::redirect('ebay/itemspecific');

            }
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Products";
		$this->template->content = \View::forge('itemspecific/create');

	}

	public function action_edit($specific_id = null)
	{
		is_null($specific_id) and \Response::redirect('itemspecific');

        $itemspecific = Model_Itemspecific::find('all', array(
            'where' => array(
                array('specific_id', $specific_id),
            ),
        ));

		if ( ! $itemspecific )
		{
			\Session::set_flash('error', 'Could not find itemspecific #'.$specific_id);
			\Response::redirect('ebay/itemspecific');
		}

        $val = Model_Itemspecific::validate('edit');

		if ($val->run())
		{
            $user_info = \Auth::get_user_id();
            $sp_id = \Input::post('id');
            $sp_name = \Input::post('name');
            $sp_value = \Input::post('value');

            foreach($sp_name as $key=>$value){

                if(array_key_exists($key,$sp_id)){
                    $itemspecific = Model_Itemspecific::find($sp_id[$key]);

                    $itemspecific->specific_id = \Input::post('specific_id');
                    $itemspecific->product_id = \Input::post('product_id');
                    $itemspecific->product_name = \Input::post('product_name');
                    $itemspecific->name = $sp_name[$key];
                    $itemspecific->value = $sp_value[$key];

                    if (!$itemspecific or !$itemspecific->save()){
                        \Session::set_flash('error', 'Could not save itemspecific.');
                        \Response::redirect('ebay/itemspecific');

                    }

                }else{
                    $itemspecific = Model_Itemspecific::forge(array(
                        'user_id' => $user_info[1],
                        'specific_id' => \Input::post('specific_id'),
                        'product_id' => \Input::post('product_id'),
                        'product_name' => \Input::post('product_name'),
                        'name' => $sp_name[$key],
                        'value' => $sp_value[$key],
                    ));

                    if (!$itemspecific or !$itemspecific->save()){
                        \Session::set_flash('error', 'Could not save itemspecific.');
                        \Response::redirect('ebay/itemspecific');

                    }
                }


            }
            \Session::set_flash('success', 'Created itemspecific ');
            \Response::redirect('ebay/itemspecific');
		}

		else
		{
			if (\Input::method() == 'POST')
			{
                $user_info = \Auth::get_user_id();
                $itemspecific->user_id = $user_info[1];

				\Session::set_flash('error', $val->error());
			}

			$this->template->set_global('itemspecific', $itemspecific, false);
		}

		$this->template->title = "Itemspecifics";
		$this->template->content = \View::forge('itemspecific/edit');

	}

	public function action_delete($itemspecific_id = null)
	{
		is_null($itemspecific_id) and \Response::redirect('ebay/itemspecific');

		if ($itemspecific = Model_Itemspecific::find($itemspecific_id))
		{
			$itemspecific->delete();

			\Session::set_flash('success', 'Deleted itemspecific #'.$itemspecific_id);
		}

		else
		{
			\Session::set_flash('error', 'Could not delete itemspecific #'.$itemspecific_id);
		}

		\Response::redirect('ebay/itemspecific');

	}

}
