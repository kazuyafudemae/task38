<?php

if (! function_exists('set_message')) {
	function set_message($msg = null, $is_success = true) {
		session()->flash('message', $msg);
		session()->flash('is_success', $is_success);
	}
}
