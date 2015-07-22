<?php
/*
Plugin Name: Gss Password Generator
Plugin URI: 
Description: This is a simple password generator that let you create strong passwords.
Version: 0.1
Author: Gurjeet Singh
Author URI: 
License: GPLv2
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class GssPasswordGenerator {

	//** Consntructor **//
	function __construct() {
		
		//** Action to load Assets Css **//
		//add_action( 'wp_enqueue_scripts',  array(&$this, 'loadAssectCss') );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );		
	}
	
	function admin_menu () {		
		add_options_page( "Gss Password Generator", "Gss Password Generator", "manage_options", "gss_password", array(&$this, 'settings_page'));
	}

	function  settings_page () {

		$password = '';
		if( isset( $_POST['generatePass']) ){
			$password = $this->generatePassword( trim($_POST['size']) );
		}

		echo '<div class="warp">';
		echo '<h2>Gss Password Generator</h2>';		
			echo '<div class="gss_form">';
				echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">';
					// echo '<input type="text" name="size" value="'.$password.'" />';
					echo '<select name="size">';
						echo '<option value="">Select Length</option>';
						for($i = 5; $i <= 100; $i++):
							echo '<option value="'.$i.'">'.$i.'</option>';
						endfor;	
					echo '</select>';
					echo '<input type="hidden" value="1" name="generatePass" />';
					echo '<input type="submit" Value="Generate Password" />';
				echo '</form>';
			echo '</div>';

			if( $password  !== '' ) {
				echo '<div class="gss_password_message">';
					echo '<p>';
						echo '<strong>';
							echo 'Generated Password: ';							
						echo '</strong>';
						echo '<span>';
							echo '<input type="text" name="size" value="'.$password.'" />';
							// echo $password;
						echo '</pan>';
					echo '</p>';

					echo '<p style="font-size: 20px;">';
						echo '<strong>';
							echo 'Remember Your Password: ';							
						echo '</strong>';
						echo '<span>';
							echo $this->rememberString( $password );							
						echo '</pan>';
					echo '</p>';
				echo '</div>';
			}	

		echo '</div>';
	}

	function generatePassword( $length = 10 ){
		return wp_generate_password( $length, true, true );
	}

	function rememberString( $password ){

		$alphabets = array(
							'a'	 => 'accessible', 
							'A'	 => 'Accession', 
							
							'b'	 => 'baboon', 
							'B'	 => 'Baby', 

							'c'	 => 'cab', 
							'C'	 => 'Cabin', 

							'd'	 => 'daisy', 
							'D'	 => 'Danger', 

							'e'	 => 'early', 
							'E'	 => 'Earth', 

							'f'	 => 'factory', 
							'F'	 => 'Family', 								

							'g'	 => 'game', 
							'G'	 => 'Ghost', 

							'h'	 => 'hamburger', 
							'H'	 => 'Hand', 

							'i'	 => 'iceberg', 
							'I'	 => 'India', 

							'j'	 => 'jam', 
							'J'	 => 'Jacket', 

							'k'	 => 'kangaroo', 
							'K'	 => 'Kansas', 

							'l'	 => 'lady', 
							'L'	 => 'Lemon', 

							'm'	 => 'magazine', 
							'M'	 => 'Magnet', 

							'n'	 => 'narrow', 
							'N'	 => 'Neptune', 

							'o'	 => 'ocean', 
							'O'	 => 'October', 

							'p'	 => 'panda', 
							'P'	 => 'Paper', 

							'q'	 => 'quarter', 
							'Q'	 => 'Quasar', 

							'r'	 => 'radar', 
							'R'	 => 'Raisin', 

							's'	 => 'sail', 
							'S'	 => 'Sandals', 

							't'	 => 'taco', 
							'T'	 => 'Target', 

							'u'	 => 'ungulate', 
							'U'	 => 'Uranus', 

							'v'	 => 'valley', 
							'V'	 => 'Vermont', 

							'w'	 => 'wallaby', 
							'W'	 => 'Washington', 

							'x'	 => 'xenops', 
							'X'	 => 'Xiaosaurus', 

							'y'	 => 'yacht', 
							'Y'	 => 'Yogurt', 

							'z'	 => 'zigzag', 
							'Z'	 => 'Zucchini', 

						);
		
		 $strlen = strlen( $password );		
		
		$rememberString = ''; 
		for( $i = 0; $i <= $strlen; $i++ ) {
			
			$char = substr( $password, $i, 1 );

			if( !empty( $alphabets[$char] ) ):
				$rememberString .= '&nbsp;&nbsp;'. $alphabets[$char];
			else:
				$rememberString .= '&nbsp;&nbsp;'. $char;
			endif;			
		}

		return $rememberString;

	}
	
}//** Class ends here. **//



$GssPasswordGenerator = new GssPasswordGenerator;

?>