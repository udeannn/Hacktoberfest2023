<div class="loader" />

<style>
	.loader {
		position: absolute;
		padding: 10px;
		width: 100%;
		height: 100%;
		z-index: 2;
	}

	.loader::before {
		content: '';
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 50px;
		height: 50px;
		border: 2px solid #111;
		border-left: 2px solid transparent;
		border-radius: 50%;
		animation: loading 500ms linear infinite;
	}

	@keyframes loading {
		100% {
			transform: translate(-50%, -50%) rotate(360deg);
		}
	}
</style>
