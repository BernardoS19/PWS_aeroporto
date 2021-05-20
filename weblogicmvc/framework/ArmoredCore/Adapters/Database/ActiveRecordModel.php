<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 19-04-2017
 * Time: 21:38
 */

namespace ArmoredCore\Adapters\Database;

use Illuminate\Validation\Validator;
use Illuminate\Database\Eloquent\Model as Eloquent;
use ArmoredCore\Bridges\ValidatorFactory;

use Tracy\Debugger;

class ActiveRecordModel extends Eloquent
{
    private static $_tracyPanelCreated = false;
    protected function attributes(){}

    public function is_valid()
    {
        // make a new validator object
        $validator = (new ValidatorFactory())->make(
            $this,
            $this->attributes()
        );

        //$validator = new Validator(null, $this, $this->attributes());
        //$validator = Validator::make($this, $this);
        // return the result
        return $validator->passes();
    }

    public function is_invalid()
    {
        // make a new validator object
        $validator = Validator::make($this, $this->attributes());
        // return the result
        return $validator->fails();
    }

    /*
      public function __construct() {

          parent::__CONSTRUCT();


          parent::__CONSTRUCT( $attributes=array(), $guard_attributes=true, $instantiating_via_find=false, $new_record=true);

          if (!self::$_tracyPanelCreated) {

              $conn = Parent::connection();

              $db1Panel = new \Filisko\PDOplus\Tracy\BarPanel( $conn->connection );
              $db1Panel->title = "DB SQL";
              Debugger::getBar()->addPanel( $db1Panel );

              self::$_tracyPanelCreated = true;
          }

  }
*/

}