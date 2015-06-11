<?php
/* 
 * dblayer.php - A MySQL wrapper class in PHP.
 * Author: G. Vamsee Krishna <vamsee_k@students.iiit.ac.in>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to:
 *                  Free Software Foundation, Inc.,
 *                  59 Temple Place - Suite 330,
 *                  Boston, MA 02111-1307, USA.
 *
 *
 * This is by no means a complete and comprehensive wrapper class. Yet to add some functions and
 * proper error-checking mechanisms. An optional ``verbose'' functionality would be nice for debugging.
 * But as long as this suits my needs, I won't be making any changes.
 *
 */
class sql_db
{		function sql_db(
			$server = "localhost",
			//$server = "localhost",
			$username = "root",
			$password = "esagu123",
			$database = "esagu2012",
			$persistency = true,
			$debug = false
		)
{	
		$this->sql_server = $server;
		$this->sql_user = $username;
		$this->sql_password = $password;
		$this->sql_database = $database;
		$this->sql_persistency = $persistency;
		$this->sql_debug = $debug;

		if( !$persistency )
			$this->sql_connection = @mysql_connect( $server, $username, $password );
		else
			$this->sql_connection = @mysql_pconnect( $server, $username, $password );

		if( !$this->sql_connection )
			print "Attempt to connect failed " . mysql_error() . "\n";
		else
		{
			if( $database )
			{
				$db_select_result = @mysql_select_db( $database, $this->sql_connection );
				if( !$db_select_result )
			print "Cannot select database <b>" . $database . "</b> " . mysql_error() . "<br>\n" ;
			}
		}
}
	/* 
	 *	Rest of the functions implemented in alphabetical order of mysql functions as in PHP manual.
	 *	If you don't believe me, check out http://www.php.net/manual/en/ref.mysql.php
	 */
	function sql_affected_rows()
	{
		$this->affected_rows = 0;
		if( $this->sql_connection )
			$this->affected_rows = @mysql_affected_rows( $this->connection );
		else
			$this->affected_rows = @mysql_affected_rows();
		
		return $this->affected_rows;
	}
	
	/*
	 *	PENDING:
	 *	mysql_change_user -- Change logged in user of the active connection
	 *	mysql_client_encoding -- Returns the name of the character set
	 */

	function sql_close()
	{
		if( $this->sql_connection )
			@mysql_close( $this->connection );
	}

	function sql_data_seek( $num_rows_to_seek = 1 )
	{
		if( $this->sql_result )
			$result = @mysql_data_seek( $this->sql_result, $num_rows_to_seek );

		if( !$result )
		{
			print "Failed to seek data " . mysql_error() . "<br>\n";
			return false;
		}
		return true;
	}

	function sql_fetch_array( $type = MYSQL_BOTH )
	{
		$this->sql_array = array();
		if( $this->sql_result )
			$this->sql_array = @mysql_fetch_array( $this->sql_result, $type );

		return $this->sql_array;
	}

	function sql_fetch_assoc()
	{
		return sql_fetch_array( MYSQL_ASSOC );
	}

	function sql_fetch_field( $offset = 0 )
	{
		if( $this->sql_result )
			$field_object = @mysql_fetch_field( $this->sql_result, $offset );
		return $field_object;
	}

	function sql_fetch_lengths()
	{
		$lengths = array();
		if( $this->sql_result )
			$lengths = @mysql_fetch_lengths( $this->sql_result );

		return $lengths;
	}

	function sql_fetch_object()
	{
		$object = null;
		if( $this->sql_result )
			$object = @mysql_fetch_object( $this->sql_result );

		return $object;
	}

	function sql_fetch_row()
	{
		return $this->sql_fetch_array( MYSQL_NUM );
	}

	function sql_field_flags( $offset = 0 )
	{
		$return_string = "";

		if( $this->sql_result )
			$return_string = @mysql_field_flags( $this->sql_result, $offset );

		return $return_string;
	}

	function sql_field_len( $offset = 0 )
	{
		$field_length = 0;

		if( $this->sql_result )
			$field_length = @mysql_field_len( $this->sql_result, $offset );
		
		return $field_length;
	}

	function sql_field_name( $offset = 0 )
	{
		$field_name = "";
		
		if( $this->sql_result )
			$field_name = @mysql_field_name( $this->sql_result, $offset );

		return $field_name;
	}

	function sql_field_names()
	{
		$field_names = array();
		$count = 0;
		if( $this->sql_result )
		{
			$max_rows = $this->sql_num_fields();
			while( $count < $max_rows )
				$field_names[$count++] = $this->sql_field_name( $count-1 );
		}
		return $field_names;
	}
	function sql_field_seek( $offset = 0 )
	{
		$field_seek = 0;

		if( $this->sql_result )
			$field_seek = @mysql_field_seek( $this->sql_result, $offset );

		return $field_seek;
	}

	function sql_field_table( $offset = 0 )		/* Get name of the table the specified field is in */
	{
		$field_table = "";

		if( $this->sql_result )
			$field_table = @mysql_field_table( $this->sql_result, $offset );

		return $field_table;
	}

	function sql_field_type( $offset = 0 )
	{
		$field_type = "";
	
		if( $this->sql_result )
			$field_type = @mysql_field_type( $this->sql_result, $offset );

		return $field_type;
	}

	function sql_free_result()
	{
		@mysql_free_result( $this->sql_result );
	}

	function sql_info()
	{
		$last_query_info = "";

		$last_query_info = @mysql_info( $this->sql_result );

		return $last_query_info;
	}

	function sql_insert_id()	/* Get the ID generated from the previous (syntactically correct) INSERT operation */
	{
		$last_correct_query_id = 0;

		$last_correct_query_id = @mysql_insert_id( $this->sql_connection );

		return $last_correct_query_id;
	}

	function sql_list_dbs()
	{
		$this->sql_result = @mysql_list_dbs( $this->sql_connection );
		if( !$this->sql_result )
			print "cannot get a list of databases from the server " . mysql_error() . "<br>\n";
	}

	/* PENDING: mysql_list_processes */

	function sql_list_fields($tableName)
	{
		$this->sql_result = @mysql_list_fields( $this->sql_database, $tableName, $this->sql_connection );
		if( !$this->sql_result )
			print "cannot get a list of databases from the server " . mysql_error() . "<br>\n";
			return;
		return $this->sql_result;
	}

	function sql_num_fields()
	{
		$num_fields = 0;

		if( $this->sql_result )
			$num_fields = @mysql_num_fields( $this->sql_result );

		return $num_fields;
	}

	function sql_num_rows()
	{
		/* Number of rows in the last SELECT operation. */
		$num_rows = 0 ;
		
		if( $this->sql_result )
			$num_rows = @mysql_num_rows( $this->sql_result );
		
		return $num_rows;
	}

	function sql_query( $query = "" )
	{
		unset( $this->sql_result );
			
		$this->sql_result = @mysql_query( $query, $this->sql_connection );
		
		if( !$this->sql_result )
			print " cannot run query \"<b>$query</b>\" " . mysql_error() . "<br>\n";
		return $this->sql_result;
	}

	function sql_select_db( $database = "test" )
	{
		$this->sql_database = $database;
		$select_db_result = @mysql_select_db( $database );

		if( !$select_db_result )
			print "cannot select database <b>$database</b> " . mysql_error() . "<br>\n";
		return $select_db_result;
	}
	
	/*
	 *	A few good functions. Functions to fetch whole set of arrays and rows. Let's see how they work
	 */
	
	function sql_fetch_array_set( $type = MYSQL_BOTH )
	{
		/* 
		 * Returns all the rows in the result of last query executed. 
		 * Check out the format though. I believe that the returned result is an array of arrays or something like that :-)
		 * Always a good idea to test a function before you use it.
		 */
		
		$num_rows = $this->sql_num_rows();
		$array_set = array();
		for( $count = 0 ; $count < $num_rows ; $count++ )
			$array_set[$count] = $this->sql_fetch_array($type);
		return $array_set;
	}
	
	function sql_fetch_row_set( $type = MYSQL_NUM )
	{
		$num_rows = $this->sql_num_rows();
		$array_set = array();
		for( $count = 0 ; $count < $num_rows ; $count++ )
			$array_set[$count] = $this->sql_fetch_row();
		return $array_set;
	
	}
}
?>
