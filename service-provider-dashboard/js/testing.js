AWS.config.region = 'ap-south-1'; // 1. Enter your region
AWS.config.credentials = new AWS.CognitoIdentityCredentials({
    IdentityPoolId: 'ap-south-1:0d3824be-4bcd-4ac8-8f34-b29baa427f00' // 2. Enter your identity pool
});
AWS.config.credentials.get(function (err) {
    if (err) alert(err);
    console.log(err);
});
var bucket = new AWS.S3({
    params: {Bucket: 'airportzoapp'}
});