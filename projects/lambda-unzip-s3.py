import os
import boto3
import zipfile

s3 = boto3.client('s3')

def lambda_handler(event, context):
    source_bucket = event['Records'][0]['s3']['bucket']['name']
    zip_file_key = event['Records'][0]['s3']['object']['key']
    destination_bucket = "testing-lambdaaa"

    # Temporarily download the zip file to /tmp directory
    temp_file_path = '/tmp/' + os.path.basename(zip_file_key)
    s3.download_file(source_bucket, zip_file_key, temp_file_path)

    # Unzip the contents
    with zipfile.ZipFile(temp_file_path, 'r') as zip_ref:
        zip_ref.extractall('/tmp/unzipped')

    # Upload the unzipped contents to the destination bucket
    for root, dirs, files in os.walk('/tmp/unzipped'):
        for file in files:
            local_path = os.path.join(root, file)
            relative_path = os.path.relpath(local_path, '/tmp/unzipped')
            s3_path = os.path.join(os.path.dirname(zip_file_key), relative_path)
            s3.upload_file(local_path, destination_bucket, s3_path)

    # Clean up the temporary files and delete the original zip file
    os.remove(temp_file_path)
    for root, dirs, files in os.walk('/tmp/unzipped'):
        for file in files:
            os.remove(os.path.join(root, file))
        for dir in dirs:
            os.rmdir(os.path.join(root, dir))
    os.rmdir('/tmp/unzipped')

    # Delete the original zip file from the source bucket
    s3.delete_object(Bucket=source_bucket, Key=zip_file_key)

    return {
        'statusCode': 200,
        'body': 'Unzip process completed successfully.'
    }
