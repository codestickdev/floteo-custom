<section class="container-fluid floteo__numbers floteoInNumbers" id="f_numbers">
	<h4 class="floteo__numbers-head">Floteo w liczbach</h4>
	<div class="container floteo__numbers-wrap">
		<div class="floteo__numbers-item">
			<div class="floteo__numbers-data">
				<div class="floteo__numbers-data-values">
					<span class="floteo__numbers-data-number number" number="<?php the_field('satisfied_customers') ?>">0</span>
					<span class="desc">zadowolonych klientów</span>
				</div>
				<div class="floteo__numbers-dot --first"></div>
				<div class="floteo__numbers-dot --second"></div>
			</div>
		</div>
		<div class="floteo__numbers-item">
			<div class="floteo__numbers-data">
				<div class="floteo__numbers-data-values">
					<span class="floteo__numbers-data-number number" number="<?php the_field('rented_cars') ?>">0</span>
					<span class="desc">wynajętych samochodów</span>
				</div>
				<div class="floteo__numbers-dot --third"></div>
			</div>
		</div>
		<div class="floteo__numbers-item">
			<div class="floteo__numbers-data">
				<div class="floteo__numbers-data-values">
					<span class="floteo__numbers-data-number --small number" number="<?php the_field('contracted_kilometers') ?>">0</span>
					<span class="desc">zakontraktowanych kilometrów</span>
				</div>
				<div class="floteo__numbers-dot --fourth"></div>
			</div>
		</div>
	</div>
</section>