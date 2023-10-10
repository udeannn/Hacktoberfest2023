##############################################################
# Author : H0llyW00dzZ                                       #
# Github : github.com/H0llyW00dzZ                            #
# License : MIT                                              #
# Tool : Fine-tuning OpenAI API GPT-3.5 Turbo model Uploader.#
# Usage : python main.py --file <file.json> --token <token>  #
##############################################################

import argparse
import requests
import json
import time
import os
import colorama
from tqdm import tqdm

# Initialize colorama
colorama.init()

# Define color codes
Colors = {
    "RED": colorama.Fore.RED,
    "YELLOW": colorama.Fore.YELLOW,
    "BLUE": colorama.Fore.BLUE,
    "CYAN": colorama.Fore.CYAN,
    "WHITE": colorama.Fore.WHITE,
    "GREEN": colorama.Fore.GREEN,
    "RESET": colorama.Fore.RESET,
    "BOLD": colorama.Style.BRIGHT,
}

# Parse command-line arguments
parser = argparse.ArgumentParser(prog='python main.py', description='Fine-tune OpenAI API GPT-3.5 Turbo model Uploader.')
parser.add_argument('--file', type=str, help='Path to the file')
parser.add_argument('--token', type=str, help='OpenAI API token')
args = parser.parse_args()

if not any(vars(args).values()):
    print(Colors['RED'] + '[-]' + Colors['RESET'], 'Failed to start.')
    parser.print_help()
    exit()

# Step 2: Upload the training data file
def upload_file(file_path):
    url = 'https://api.openai.com/v1/files'
    headers = {
        'Authorization': f'Bearer {args.token}'
    }
    data = {
        'purpose': 'fine-tune'
    }
    files = {
        'file': open(file_path, 'rb')
    }

    response = requests.post(url, headers=headers, data=data, files=files)
    response_json = response.json()
    return response_json.get('id')

# Check if the uploaded file is processed
def is_file_processed(file_id):
    url = f'https://api.openai.com/v1/files/{file_id}'
    headers = {
        'Authorization': f'Bearer {args.token}'
    }

    response = requests.get(url, headers=headers)
    response_json = response.json()
    return response_json.get('status') == 'processed'

# Step 3: Create a fine-tuning job
def create_fine_tuning_job(file_id):
    url = 'https://api.openai.com/v1/fine_tuning/jobs'
    headers = {
        'Content-Type': 'application/json',
        'Authorization': f'Bearer {args.token}'
    }
    data = {
        'training_file': file_id,
        'model': 'gpt-3.5-turbo-0613'
    }

    response = requests.post(url, headers=headers, json=data)
    response_json = response.json()
    return response_json.get('id')

# Check if the fine-tuning job is ready
def is_job_ready(job_id):
    url = f'https://api.openai.com/v1/fine_tuning/jobs/{job_id}'
    headers = {
        'Authorization': f'Bearer {args.token}'
    }

    response = requests.get(url, headers=headers)
    response_json = response.json()
    return response_json.get('status') == 'succeeded'

# Wait until the fine-tuning job is ready
def wait_for_job(job_id):
    start_time = time.time()  # Record the start time

    while not is_job_ready(job_id):
        elapsed_time = time.time() - start_time  # Calculate the elapsed time
        print(f'\r{Colors["YELLOW"]}[!]{Colors["RESET"]} Waiting for fine-tuning job to complete... Elapsed Time: {elapsed_time:.2f} seconds', end='')
        time.sleep(1)

# Main function
def main():
    start_time = time.time()  # Record the start time
    print(Colors['YELLOW'] + '[!]' + Colors['RESET'], 'Starting... Elapsed Time: 0.00 seconds')

    # Upload the training data file
    file_id = upload_file(args.file)
    if file_id is None:
        print(Colors['RED'] + '[-]' + Colors['RESET'], 'File upload failed.')
        return

    elapsed_time = time.time() - start_time  # Calculate the elapsed time
    print(Colors['GREEN'] + '[+]' + Colors['RESET'], 'File uploaded successfully. File ID:', file_id, f'Elapsed Time: {elapsed_time:.2f} seconds')

    # Check if the uploaded file is processed
    start_time = time.time()  # Record the start time
    while not is_file_processed(file_id):
        elapsed_time = time.time() - start_time  # Calculate the elapsed time
        print(f'\r{Colors["YELLOW"]}[!]{Colors["RESET"]} Waiting for file processing... Elapsed Time: {elapsed_time:.2f} seconds', end='')
        time.sleep(1)

    print('\n' + Colors['GREEN'] + '[+]' + Colors['RESET'], 'File processing completed.')
    elapsed_time = time.time() - start_time  # Calculate the elapsed time
    print(Colors['YELLOW'] + '[!]' + Colors['RESET'], 'Starting Fine-tuning Job... Elapsed Time:', f'{elapsed_time:.2f} seconds')

    # Create the fine-tuning job
    job_id = create_fine_tuning_job(file_id)
    if job_id is None:
        print(Colors['RED'] + '[-]' + Colors['RESET'], 'Fine-tuning job creation failed.')
        return

    elapsed_time = time.time() - start_time  # Calculate the elapsed time
    print(Colors['GREEN'] + '[+]' + Colors['RESET'], 'Fine-tuning job created successfully. Job ID:', job_id)

    # Wait for the fine-tuning job to complete
    start_time = time.time()  # Record the start time
    wait_for_job(job_id)

    print('\n' + Colors['GREEN'] + '[+]' + Colors['RESET'], 'Fine-tuning job completed.')
    elapsed_time = time.time() - start_time  # Calculate the elapsed time
    print(Colors['YELLOW'] + '[!]' + Colors['RESET'], f'Elapsed Time: {elapsed_time:.2f} seconds')

    # Get the fine-tuned model from the completed job
    url = f'https://api.openai.com/v1/fine_tuning/jobs/{job_id}'
    headers = {
        'Authorization': f'Bearer {args.token}'
    }

    response = requests.get(url, headers=headers)
    response_json = response.json()
    fine_tuned_model = response_json.get('fine_tuned_model')

    # Print the fine-tuned model
    if fine_tuned_model:
        print('\nFine-tuned model ready to use:', fine_tuned_model)
    else:
        print('No fine-tuned model available.')

if __name__ == '__main__':
    main()