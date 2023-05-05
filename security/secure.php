<?php
 $input_data = json_decode(file_get_contents("php://input"));
 $input = (parse_ini_file("../../myconfig.ini"));
//  $database_name = $input['database_name'];
//  $database_username = $input['database_username'];
//  $database_password = $input['database_password'];
//  $ses_emailid = $input['ses_emailid'];
//  $ses_host = $input['ses_host'];
//  $ses_username = $input['ses_username'];
//  $ses_password = $input['ses_password'];
 $s3_cloudfront = $input['s3_cloudfront'];
 $s3_bucket = $input['s3_bucket'];
 $s3_poolid = $input['s3_poolid'];
?>
<script src="js/aws-sdk.min.js"></script>
<script>
    let awsPoolId = "<?php echo $s3_poolid?>";
    let awsBucketName = "<?php echo $s3_bucket?>";
    let awsCloudFrontUrl = "<?php echo $s3_cloudfront?>";

    AWS.config.region = "ap-south-1"; // 1. Enter your region
    AWS.config.credentials = new AWS.CognitoIdentityCredentials({
        IdentityPoolId: awsPoolId, // 2. Enter your identity pool
    });
    AWS.config.credentials.get(function (err) {
        if (err) alert(err);
    });
    var bucket = new AWS.S3({
        params: { Bucket: awsBucketName },
    });
    var aws_cloudfront_url = awsCloudFrontUrl;
</script>