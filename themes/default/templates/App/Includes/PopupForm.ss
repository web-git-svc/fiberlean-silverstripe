<div class="popup-form__holder">
	<button class="popup-form__round-button" data-toggle-popup-form>
		{$SVGIcon('message', 36, 36)}
	</button>

	<div class="popup-form__bubble" data-popup-form-holder>
		<div class="popup-form__bubble-inner">
			<button class="popup-form__close-button" data-toggle-popup-form>
				{$SVGIcon('close', 20, 20)}
			</button>

			<div data-popup-form-container>
				<h2>
					Request for more information
				</h2>

				<p>
					To make an enquiry please complete the form below.
				</p>

				<div>
					{$PopupForm}
				</div>

				<div class="popup-form__loader" data-popup-loader></div>
			</div>
		</div>
	</div>
</div>
