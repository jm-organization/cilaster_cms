<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 27.08.2017
 * @Time: 15:28
 *
 * @documentation:
 */

namespace Cilaster\DB\Tables;


interface Table {

	public function set( $item );

	public function get( $item );

	public function update( $item );

	public function delete( $item );

}