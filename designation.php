<?php
		require ('db_conn.php');
		$id = $_POST['id'];
		echo '<div>';
                                
        $group = $conn->query("SELECT * FROM police_profiling WHERE position NOT IN ('PSINSP', 'PINSP') AND id NOT IN (SELECT cc.police_id FROM police_profiling as pp JOIN checkpoint_composition cc ON pp.id = cc.police_id JOIN checkpoints AS c ON c.id = cc.checkpoint_id WHERE pp.position NOT IN ('PSINSP', 'PINSP') AND c.operation_id = (SELECT operation_id FROM checkpoints WHERE id = $id))");
        $i = 0;
        while($p = $group->fetch(PDO::FETCH_ASSOC)){
               $team[$i] = array("id" => $p["id"], 
               "name" => $p["last_name"].", ".$p["first_name"]." ".substr($p["middle_name"], 0, 1).".",
                "position" => $p["position"],
               "image" => $p["image"]
                );
         $i++;
        }
          echo '<select name="title[]" class="form-control" style="width:20%;" disabled>  <option value="SPO4">SPO4</option>
                <option value="SPO3">SPO3</option>         
                <option value="SPO2">SPO2</option>
                <option value="SPO1">SPO1</option>
                <option value="PO4">PO4</option>
                <option value="PO3">PO3</option>
                <option value="PO2">PO2</option>
                <option value="PO1">PO1</option></select>';
          echo "<select name='groupMembers[]' onChange='groupFn(this)' class='form-control' style='margin-top:-7.25%;margin-left:22%;width:43%;' required>";
          echo "<option value='' hidden>Team</option>";
         for($i = 0; $i < sizeof($team); $i++){
         echo "<option value=".$team[$i]["id"]." data-img=".$team[$i]["image"]." data-position=".$team[$i]["position"].">".$team[$i]["name"]."</option>";
          }
          echo "</select>";
                           
        echo '<select name="designation[]" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;" required>';
        echo '<option value="" hidden>Checkpoint Position</option>';
        echo '<option value="Spokeperson">Spokeperson</option>';
        echo '<option value="Investigating">Investigating Sub-Team</option>';
        echo '<option value="Search/Arresting Sub-Team">Search/Arresting Sub-Team</option>';
        echo '<option value="Security Sub-Team">Security Sub-Team</option>';
        echo '</select>  <a href="#" class="remove_field">Remove</a><br></div>';

?>