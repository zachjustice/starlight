<?

class Postgres {
    private $host;
    private $user;
    private $dbname;
    private $port;

    private $db_handler;

    function __construct( $host = 'starlight-one.cbabh2kcuk8s.us-west-2.rds.amazonaws.com', $user = 'postgres', $dbname = 'starlight', $port = '5432' )
    {
        $this->host = $host;
        $this->user = $user;
        $this->dbname = $dbname;
        $this->port = $port;

        if (getenv("PGPASSFILE")!="")
              putenv("PGPASSFILE=".getenv("PGPASSFILE"));

        $this->connect("pgsql:host=$host user=$user dbname=$dbname port=$port");
    }

    static public function connect( $connection_string )
    {
        $this->db_handler = new PDO( $connection_string );
    }

    /**
     * $params is a map with the following keys and expected values:
     * "tables" => array( tables_names ),
     * "columns" => array( columns ),
     * "where" => array( array( "column < value" ), array( "column > value" ) ),
     */
    static public function select( $params )
    {
        if( !array_key_exists( 'tables', $params ) )
        {
            return false;
        }

        if( !array_key_exists( 'columns', $params ) )
        {
            return false;
        }

        $query = 'SELECT ';

        foreach( $params['tables'] as $table )
        {
            $query .= "$table, ";
        }

        $query  = rtrim( $query, ', ' );
        $query .= ' FROM ';

        foreach( $params['columns'] as $column )
        {
            $query .= "$column, ";
        }

        $query = rtrim( $query, ', ' );

        if( array_key_exists( 'where', $params ) )
        {
            $query .= 'WHERE ';

            foreach( $params['where'] as $where )
            {
            }
        }

        return $query;

    }
}




