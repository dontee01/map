<?php
function count_attempts(template $mangruf, $id)
{
    $qry="SELECT * FROM login_attempts WHERE user_id = '$id' ";
    $result = $mangruf->query($qry);
    $row = $mangruf->rows($result);
    return $row;
}

function delete_attempts(template $mangruf, $id)
{
    $qry = "DELETE FROM login_attempts WHERE user_id = '$id' ";
    $result = $mangruf->query($qry);

    $upd = "UPDATE users SET is_sec_quest = 0 WHERE id = '$id' ";
    $rs = $mangruf->query($upd);
    // return $row;
}

function gen_arith_exp()
{
	$lft = mt_rand(8, 40);
	$rgt = mt_rand(12, 50);
	$resp['lft'] = $lft;
	$resp['rgt'] = $rgt;
	return $resp;
}

function gen_sec_quest(template $mangruf, $id, $cond)
{
	switch ($cond) {
		case 1:
			$q = 'fname';
			$qry = "SELECT $q FROM users WHERE id = '$id' ";
		    $result=$mangruf->query($qry);
		    $row = $mangruf->rows($result);
		    if ($row == 1)
		    {
            	$member = $mangruf->fetch($result);
                extract($member);
            $upd = "UPDATE users SET is_sec_quest = 1, sec_answer = '$fname' WHERE id = '$id' ";
                $rs = $mangruf->query($upd);
                return 'What is your first name ?';
		    }

			break;

		case 2:
			$q = 'lname';
			$qry = "SELECT $q FROM users WHERE id = '$id' ";
		    $result = $mangruf->query($qry);
		    $row = $mangruf->rows($result);
		    if ($row == 1)
		    {
            	$member = $mangruf->fetch($result);
                extract($member);
            $upd = "UPDATE users SET is_sec_quest = 1, sec_answer = '$lname' WHERE id = '$id' ";
                $rs = $mangruf->query($upd);
                return 'What is your last name ?';
		    }

			break;
		
		default:
			$res = gen_arith_exp();
			$lft = $res['lft'];
			$rgt = $res['rgt'];
			$ans = $res['lft'] + $res['rgt'];
            $upd = "UPDATE users SET is_sec_quest = 1, sec_answer = '$ans' WHERE id = '$id' ";
            $rs = $mangruf->query($upd);
            return "{$lft} + {$rgt} = ";
			break;
	}
}