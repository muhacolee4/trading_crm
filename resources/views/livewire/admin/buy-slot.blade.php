<div>
    <form wire:submit.prevent='purchaseSlot'>
        @csrf
        <div class="form-group">
            <label for="">Number of Slot</label>
            <input type="number" name="numofslot" wire:keyup='calculateSlot' wire:model='slot' class="form-control"
                required>
            <small class="text-danger">{{ $message }}</small>
        </div>
        <div class="form-group">
            <label for="">You will be charged ($)</label>
            <input type="number" name="amount" wire:model='amount' class="form-control" readonly>
            <small>Amount will be deducted from your wallet</small>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Purcahse</button>
        </div>
    </form>
</div>
