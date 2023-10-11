# Fine-tuning OpenAI API GPT-3.5 Turbo model Uploader

[![Language: Python](https://img.shields.io/badge/Language-Python-blue.svg)](https://www.python.org)

This project provides a Python script (`main.py`) that allows you to fine-tuning the OpenAI GPT-3.5 Turbo model by uploading a training data file. It automates the process of uploading the file, creating a fine-tuning job, and waiting for the job to complete.

## Showcase

![746fa145c408580e91157127f97ad9adfb133022](https://github.com/H0llyW00dzZ/OpenAI-API/assets/17626300/35cf161e-795e-409b-9168-08da9049dc78)

## Prerequisites

Before using the `main.py` script, make sure you have the following prerequisites:

- Python installed on your system.
- The `requests`, `json`, `time`, `os`, `colorama`, and `tqdm` libraries installed. You can install them using `pip`.

## Installation

1. Clone or download this repository to your desired location.

2. Install the required Python libraries using the following command:

   ```shell
   pip install requests colorama tqdm
   ```
   or
   ```shell
   pip install -r requirements.txt
   ```

## Usage

Run the following command to use the `main.py` script:

```shell
python main.py --file <file.json> --token <token>
```

Replace `<file.json>` with the path to your training data file in JSON format, and `<token>` with your OpenAI API token.

## License

This project is licensed under the [MIT License](LICENSE). Feel free to modify and distribute the code as per the terms of the license.
