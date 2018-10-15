		<li>
            <div class="history">
                <h6 class="weekday" title="Veckodag"><?php echo $this->general_model->days[$history['day'] - 1]; ?></h6>
                <h6 class="week" title="Vecka"><?php echo str_pad($history['week'], 2, 0, STR_PAD_LEFT); ?></h6>
                <h6 class="year" title="År"><?php echo $history['year']; ?></h6>
            </div>
        </li>