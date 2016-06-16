<?php
	require('conn.php');

	$Name = $_POST["Name"];
	$Evolution = $_POST["Evolution"];
	$Elements = $_POST["Elements"];

	if( isset($_POST['Action'])) {
		switch ($_POST['Action']) {
			case 'Send':
				cstins( $Name, $Evolution, $Elements, $conn );
				showAll( $conn );
				break;
			case 'Delete':
				cstdel( $Name, $Evolution, $Elements, $conn);
				showAll( $conn );
				break;
		}
	};

	function cstins( $Name, $Evolution, $Elements, $conn) {

		$ins = $conn -> prepare("INSERT INTO Pokemons (Name, Evolution, Elements) VALUES (:Name, :Evolution, :Elements)");
		$ins -> bindValue(":Name", $Name);
		$ins -> bindValue(":Evolution", $Evolution);
		$ins -> bindValue(":Elements", $Elements);
			if( $ins -> execute() == true) {
				return true;
			}else{
				echo "Error";
			}
		}
	}

	function cstdel ( $Name, $Evolution, $Elements, $conn ) {
		$del = $conn -> prepare("DELETE FROM Pokemons WHERE Name='".$Name."'");
		if( $del -> execute() == true) {
			return true;
		}else{
			echo "Error";
		}
	}

	function showAll ( $conn ) {
		$asel = $conn -> prepare("SELECT * FROM Pokemons");
			if($asel -> execute() == true) {
				$results = $asel -> fetchAll(PDO::FETCH_ASSOC);
				header('Content-Type: application/json');
				echo json_encode( $results );
			}else{
				echo "Error";
			}
	}
?>
