import boto3

def lambda_handler(event, context):
    source_bucket = 'testing-mimetype'
    destination_bucket = 'testing-mimetype'
    prefix = 'assets/'

    new_content_type = 'text/css'

    s3 = boto3.client('s3')

    try:
        response = s3.list_objects_v2(Bucket=source_bucket, Prefix=prefix)

        for obj in response.get('Contents', []):
            if obj['Key'].lower().endswith('.css'):
                source_key = obj['Key']

                s3.copy_object(
                    Bucket=destination_bucket,
                    CopySource={'Bucket': source_bucket, 'Key': source_key},
                    Key=source_key,
                    ContentType=new_content_type,
                    MetadataDirective='REPLACE',
                )

        return {
            'statusCode': 200,
            'body': 'CSS files copied with updated content-type.',
        }

    except Exception as e:
        print(f"Error: {e}")
        return {
            'statusCode': 500,
            'body': 'Error occurred while copying the files.',
        }
