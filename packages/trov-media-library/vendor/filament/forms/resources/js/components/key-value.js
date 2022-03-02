export default (Alpine) => {
    Alpine.data('keyValueFormComponent', ({
        state,
    }) => ({
        state,

        rows: [],

        shouldUpdateRows: true,

        init: function () {
            this.updateRows()

            if (this.rows.length <= 0) {
                this.addRow()
            }

            this.$watch('state', () => {
                if (! this.shouldUpdateRows) {
                    this.shouldUpdateRows = true

                    return
                }

                this.updateRows()
            })
        },

        addRow: function () {
            this.rows.push({ key: '', value: '' })

            this.updateState()
        },

        deleteRow: function (index) {
            this.rows.splice(index, 1)

            if (this.rows.length <= 0) {
                this.addRow()
            }

            this.updateState()

            this.shouldUpdateRows = true
        },

        updateRows: function () {
            let rows = []

            for (let [key, value] of Object.entries(this.state ?? {})) {
                rows.push({
                    key,
                    value,
                })
            }

            this.rows = rows
        },

        updateState: function () {
            let state = {}

            this.rows.forEach((row) => {
                if (row.key === '' || row.key === null) {
                    return
                }

                state[row.key] = row.value
            })

            // This is a hack to prevent the component from updating rows again
            // after a state update, which would otherwise be done by the `state`
            // watcher. If rows are updated again, duplicate keys are removed.
            //
            // https://github.com/laravel-filament/filament/issues/1107
            this.shouldUpdateRows = false

            this.state = state
        },
    }))
}
