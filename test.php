<? 
require_once( 'php/Postgres.php' );

$pgsql = new Postgres();
$query = array( 
    'tables' => array( 'tb_user', 'tb_this', 'tb_that' ),
    'columns' => array( 'column1', 'column2' )
);

var_dump( $pgsql->select( $query ) );

?>
