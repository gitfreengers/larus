<?php
/**
 * Created by PhpStorm.
 * User: ekontiki89
 * Date: 27/07/15
 * Time: 11:11 AM
 */

namespace App\Services\Widget;

class widgets {
    /**
     * @var array
     */
    public $array = [];
    public $aux = [];
    /**
     * @param array $items
     * @return array
     */
    public function itemsArray(array $items = []){
        array_push($this->array,$items);
        return $this->array;
    }

    /**
     * @return array
     */

    public function render(){
        $arrays = $this->array;
        foreach($arrays as $array)
        {
            switch($array['option']) {
                case 1:
                    $widgetBasic = $this->widgetBasic($array);
                    array_push($this->aux, $widgetBasic);


                break;
                case 2:
                    $widgetMiddle = $this->widgetMiddle($array);
                    array_push($this->aux, $widgetMiddle);
                break;
                case 3:
                    $widgetAdvanced = $this->widgetAdvanced($array);
                    array_push($this->aux, $widgetAdvanced);
                break;
            }
        }
        return $this->aux;
    }

    /**
     * @param array $items
     * @return array
     */
    private function widgetBasic(array $items = [])
    {
        $color  = $items['color'];
        $icon   = $items['icon'];
        $msg    = $items['tittle'];
        $value      = $items['value'];
        $permission = $items['permission'];

        $arrayString = [];
        array_push($arrayString,$permission);

        $string = '
                   <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon  '. $color .'"><i class="fa '. $icon .'"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">'. $msg .'</span>
                                <span class="info-box-number">'. $value .'</span>
                            </div>
                        </div>
                    </div>

                    ';

        array_push($arrayString,$string);
        return $arrayString;
    }

    /**
     * @param array $items
     * @return string
     */
    private function widgetMiddle(array $items = [])
    {
        $color  = $items['color'];
        $icon   = $items['icon'];
        $text   = $items['tittle'];
        $number      = $items['value'];
        $description = $items['description'];
        $permission  = $items['permission'];
        $percent     = $items['percent'];

        $arrayString = [];
        array_push($arrayString,$permission);

        $string = '
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box '.$color.'">
                        <span class="info-box-icon"><i class="fa '.$icon.'"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">'.$text.'</span>
                          <span class="info-box-number">'.$number.'</span>
                          <div class="progress">
                            <div class="progress-bar" style="width: '.$percent.'%"></div>
                          </div>
                          <span class="progress-description">
                            '.$description.'
                          </span>
                        </div>
                      </div>
                    </div>
                    ';
        array_push($arrayString,$string);
        return $arrayString;
    }

    /**
     * @param array $items
     * @return string
     */

    private function widgetAdvanced(array $items = [])
    {
        $string = '';
        return $string;

    }
}
