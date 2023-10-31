<script>
	export let wordData = null;

	function playAudio(src) {
		let audio = new Audio(src);
		audio.play();
	}
</script>

<div class="word-data">
	<div class="result">
		<div class="left">
			<h1>
				{wordData.word}
			</h1>
			<p>{wordData?.phonetics[0]?.text ?? ''}</p>
		</div>
		<div class="right">
			{#if wordData?.phonetics[0]?.audio}
				<button on:click={() => playAudio(wordData.phonetics[0].audio)}>
					<svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" viewBox="0 0 75 75"
						><g fill="#A445ED" fill-rule="evenodd"
							><circle cx="37.5" cy="37.5" r="37.5" opacity=".25" /><path
								d="M29 27v21l21-10.5z"
							/></g
						></svg
					>
				</button>
			{/if}
		</div>
	</div>
	{#each wordData.meanings as meaning}
		<div class="meaning">
			<div class="part-of-speech">
				<h2>{meaning.partOfSpeech}</h2>
				<div class="line" />
			</div>
			<div class="definitions">
				<h3 class="meaning-header">Meaning</h3>
				<ul>
					{#each meaning.definitions as definition}
						<li class="definition">
							{definition.definition}
							{#if definition.example}
								<p class="example">"{definition.example}"</p>
							{/if}
						</li>
					{/each}
				</ul>
				{#if meaning.synonyms.length}
					<p class="synonyms meaning-header">Synonyms <span>{meaning.synonyms.join(', ')}</span></p>
				{/if}
			</div>
		</div>
	{/each}
	{#if wordData.sourceUrls.length}
		<div class="source">
			<h4>Source</h4>
			<a href={wordData.sourceUrls[0]} target="_blank" rel="noreferrer">{wordData.sourceUrls[0]}</a>
		</div>
	{/if}
</div>

<style>
	.result {
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-between;
		padding: 8px 16px;
	}

	.result .left h1 {
		font-size: 4rem;
		margin-bottom: 10px;
	}

	.result .left p {
		color: #a445ed;
		font-weight: bold;
		font-size: 1.3rem;
	}

	.result .right button {
		outline: none;
		cursor: pointer;
		border: none;
		background-color: transparent;
	}

	.word-data .audios .audio button {
		background: transparent;
		border: none;
	}

	.word-data .audios .audio i {
		cursor: pointer;
	}

	.word-data .meaning {
		padding: 8px 20px;
	}

	.word-data > div.meaning:last-child {
		border-bottom: 1px solid #ddd;
	}

	.part-of-speech {
		display: flex;
		flex-direction: row;
		align-items: center;
		margin: 2em 0;
	}

	.part-of-speech h2 {
		font-size: 1.4rem;
		font-weight: 600;
		margin-right: 1.4em;
	}

	.line {
		background: #ddd;
		height: 1px;
		width: 100%;
	}

	.definitions ul {
		margin-left: 2.5em;
		list-style: none;
	}

	.definitions ul li::before {
		content: '•';
		color: #a445ed;
		display: inline-block;
		width: 1em;
		margin-left: -1em;
	}

	.definitions .synonyms {
		margin-top: 0.4em;
	}

	.definitions .synonyms span {
		color: #a445ed;
		font-weight: 600;
		font-size: 1.3rem;
		margin-left: 1em;
	}

	.definitions .definition {
		padding: 2px 0;
	}

	.definitions .definition {
		margin: 5px 0;
	}

	.definition .example {
		color: #757575;
		margin-top: 4px;
	}

	.meaning-header {
		font-size: 1.2rem;
		color: #757575;
		font-weight: 400;
		letter-spacing: 0.5;
		margin-bottom: 1em;
	}

	.source {
		display: flex;
		flex-direction: row;
		align-items: center;
		margin-top: 1.5em;
	}

	.source h4 {
		color: #757575;
		font-size: 1rem;
		font-weight: 500;
		margin-right: 1em;
	}

	.source a {
		color: #000000;
	}
</style>
