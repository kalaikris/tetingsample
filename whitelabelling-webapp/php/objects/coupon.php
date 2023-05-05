<?php
class UserCoupon extends Database
{

    public function readCategoryCoupon($businessToken)
    {
        $query = "SELECT
        `coupon__condition`.`business_type_token`,
        `business_type`.`name` AS `business_name`,
        `coupon__condition`.`coupon_type`,
        `coupon__condition`.`discount_amount`,
        `coupon__condition`.`gst_type`
        FROM `coupon`
        INNER JOIN `coupon__applicable` ON (`coupon__applicable`.`coupon_token`=`coupon`.`token`)
        INNER JOIN `service__distributor` ON (`service__distributor`.`token`=`coupon__applicable`.`distributor_token`)
        INNER JOIN `coupon__condition` ON (`coupon__condition`.`coupon_token`=`coupon`.`token`)
        INNER JOIN `business_type` ON (`business_type`.`token`=`coupon__condition`.`business_type_token`)
        WHERE `coupon`.`coupon_type`='Category' AND `coupon__condition`.`business_type_token` IN ($businessToken) AND `coupon`.`code`=:code AND `coupon__applicable`.`website`='1' AND `service__distributor`.`site_name`=:site_name AND `coupon__condition`.`is_active_condition`='0' AND `coupon__applicable`.`is_active_application`='0' AND `service__distributor`.`status`='0'";

        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":code", $this->couponCode);
        $this->stmt->bindParam(":site_name", $this->site_name);
        //$this->stmt->debugDumpParams();
        $this->stmt->execute();
        $array = [];
        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->business_type_token = $row['business_type_token'];
            $obj->business_name = $row['business_name'];
            $obj->coupon_type = $row['coupon_type'];
            $obj->discount_amount = $row['discount_amount'];
            $obj->gst_type = $row['gst_type'];
            array_push($array, $obj);
        }
        return $array;
    }

    function checkActiveCoupon()
    {
        $query = "SELECT
        `coupon`.`status`,
        `coupon`.`coupon_type` AS `type`,
        `coupon`.`code`
    FROM
        `coupon`
        INNER JOIN `coupon__applicable` ON (`coupon__applicable`.`coupon_token`=`coupon`.`token`)
        INNER JOIN `service__distributor` ON (`service__distributor`.`token`=`coupon__applicable`.`distributor_token`)
    WHERE `coupon`.`status`='0' AND `coupon`.`code`=:code AND `service__distributor`.`site_name`=:site_name AND `coupon__applicable`.`is_active_application`='0' AND `service__distributor`.`status`='0'";

        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":site_name", $this->site_name);
        $this->stmt->bindParam(":code", $this->couponCode);
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass;
        $obj->status = $row['status'];
        $obj->type = $row['type'];
        $obj->code = $row['code'];
        return $obj;
    }

    function checkAvailableUserCoupon()
    {
        $query = "SELECT
        COALESCE(`coupon`.`users_per_customer`,-1) AS `available_user_coupon`,
        COUNT(`users__booking`.`token`) AS `used_coupon_count`
        FROM
        `coupon`
        INNER JOIN `coupon__applicable` ON (`coupon`.`token`=`coupon__applicable`.`coupon_token`)
        INNER JOIN `service__distributor` ON (`service__distributor`.`token`=`coupon__applicable`.`distributor_token`)
        INNER JOIN `users__booking` ON (`coupon`.`token`=`users__booking`.`coupon_token`)
        WHERE `coupon`.`code`=:code AND `coupon`.`coupon_type`='Cart' AND `coupon`.`status`='0' AND `users__booking`.`user_token`=:user_token AND `service__distributor`.`site_name`=:site_name AND `coupon__applicable`.`website`='1' AND `coupon__applicable`.`is_active_application`='0' AND `service__distributor`.`status`='0'";

        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":code", $this->couponCode);
        $this->stmt->bindParam(":user_token", $this->userToken);
        $this->stmt->bindParam(":site_name", $this->site_name);
        //$this->stmt->debugDumpParams();
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->available_user_coupon = $row['available_user_coupon']-$row['used_coupon_count'];
        return $obj;
    }

    function checkBalanceCartCoupon()
    {
        $query = "SELECT
        `users_per_coupon`-`balance_coupon_count` AS `availableCoupon`
        FROM `coupon`
        INNER JOIN `coupon__applicable` ON (`coupon`.`token`=`coupon__applicable`.`coupon_token`)
        INNER JOIN `service__distributor` ON (`service__distributor`.`token`=`coupon__applicable`.`distributor_token`)
        WHERE `coupon`.`code`=:code AND `coupon`.`status`='0' AND `coupon`.`coupon_type`='Cart' AND `coupon__applicable`.`website`='1' AND `service__distributor`.`site_name`=:site_name AND `coupon__applicable`.`is_active_application`='0' AND `service__distributor`.`status`='0'";

        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":code", $this->couponCode);
        $this->stmt->bindParam(":site_name", $this->site_name);
        //$this->stmt->debugDumpParams();
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $obj = new stdClass();
        $obj->availableCoupon = $row['availableCoupon'];
        return $obj;
    }

    function getbusinessToken()
    {
        $query = "SELECT `business_type_token` AS `business_token` FROM `service` WHERE `token` $this->serviceToken";

        $this->stmt = $this->conn->prepare($query);
        $this->stmt->execute();
        $array = [];
        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->business_token = $row['business_token'];
            array_push($array, $row['business_token']);
        }

        return $array;
    }

    function readCartCoupon()
    {
        $query = "SELECT
        `coupon`.`token` AS `coupon_token`,
        `coupon`.`discount_amount` AS `cart_dis_amt`,
        `coupon__condition`.`coupon_type`,
        `coupon__condition`.`discount_amount`,
        `coupon__condition`.`gst_type`,
        `coupon__condition`.`coupon_condition`
    FROM `coupon`
        INNER JOIN `coupon__applicable` ON (`coupon`.`token`=`coupon__applicable`.`coupon_token`)
        INNER JOIN `service__distributor` ON (`service__distributor`.`token`=`coupon__applicable`.`distributor_token`)
        INNER JOIN `coupon__condition` ON (`coupon`.`token`=`coupon__condition`.`coupon_token`)
    WHERE `coupon`.`status`='0' AND `coupon`.`coupon_type`='Cart' AND `coupon__applicable`.`website`='1' AND `coupon`.`code`=:code AND `service__distributor`.`site_name`=:site_name AND `coupon__applicable`.`is_active_application`='0' AND `coupon__condition`.`is_active_condition`='0' AND `service__distributor`.`status`='0'";

        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":code", $this->couponCode);
        $this->stmt->bindParam(":site_name", $this->site_name);
        //$this->stmt->debugDumpParams();
        $this->stmt->execute();
        $array = [];
        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass();
            $obj->coupon_token = $row['coupon_token'];
            $obj->cart_dis_amt = $row['cart_dis_amt'];
            $obj->coupon_type = $row['coupon_type'];
            $obj->discount_amount = $row['discount_amount'];
            $obj->gst_type = $row['gst_type'];
            $obj->coupon_condition = $row['coupon_condition'];
            array_push($array, $obj);
        }
        return $array;
    }

    //Read Available Coupon
    public function read()
    {
        $query = "SELECT
        `coupon`.`name`,
        `coupon`.`description`,
        `coupon`.`to_date`,
        `coupon`.`code`
    FROM
        `coupon`
        INNER JOIN `coupon__applicable` ON (`coupon`.`token`=`coupon__applicable`.`coupon_token`)
        INNER JOIN `service__distributor` ON (`service__distributor`.`token`=`coupon__applicable`.`distributor_token`)
    WHERE
        `coupon__applicable`.`website`='1' AND `coupon`.`status` = 0 AND `service__distributor`.`site_name`=:site_name AND `from_date` <= CURDATE() AND `to_date` >= CURDATE() AND `coupon__applicable`.`is_active_application`='0' AND `service__distributor`.`status`='0'";

        $this->stmt = $this->conn->prepare($query);
        $this->stmt->bindParam(":site_name", $this->site_name);

        $this->stmt->execute();

        return $this->stmt;
    }

    //Readed Available Coupon MakeView
    function makeView()
    {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->name = trim($row['name']);
            $obj->description = trim($row['description']);
            $obj->to_date = trim($row['to_date']);
            $obj->code = trim($row['code']);

            array_push($array, $obj);
        }

        return $array;
    }

    function makeCouponView()
    {
        $array = [];

        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass;
            $obj->coupon_type = trim($row['coupon_type']);
            $obj->name = trim($row['name']);
            $obj->status = trim($row['status']);
            $obj->description = trim($row['description']);
            $obj->from_date = trim($row['from_date']);
            $obj->to_date = trim($row['to_date']);
            $obj->code = trim($row['code']);

            array_push($array, $obj);
        }
        return $array;
    }
}
?>