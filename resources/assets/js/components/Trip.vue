<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Flights for trip #{{ trip }}</div>

                    <div class="panel-body">
                       <ul class="list-group">
                           <li class="list-group-item" v-for="item in availableFlights">
                               <div class="pull-right">
                                   <button v-if=!isFlightAdded(item.flight_number) @click=addFlight(item.flight_number) class="btn btn-success"> Add </button>
                                   <button v-if=isFlightAdded(item.flight_number) @click=removeFlight(item.flight_number) class="btn btn-primary"> Remove </button>
                               </div>
                               <span>
                                   flight number: {{ item.flight_number }}
                                   <br/>
                                   airport departure id: {{ item.airport_departure_id }}
                                   <br/>
                                   airport destination id: {{ item.airport_destination_id }}
                               </span>
                           </li>
                       </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['trip'],
        data() {
          return {
            availableFlights: {},
            flights: []
          }
        },
        created() {
            this.$http.get('/api/trips/' + this.trip + '/available-flights').then((response) => {
                this.availableFlights = response.body;
            }, (response) =>{

            });

            this.$http.get('/api/trips/' + this.trip + '/flights').then((response) => {
                this.flights = response.body;
            }, (response) =>{

            });
        },
        methods: {
            addFlight(number) {
                var data = new FormData();
                data.append('flight_number', number);

                this.$http.post('/api/trips/' + this.trip + '/flights', data).then((response) => {
                    if (this.flights.constructor !== Array) {
                        this.flights = [];
                    }
                    this.flights.push(response.body);
                }, (response) => {
                   console.log(response);
                });
            },
            removeFlight(number) {
                var flight = _.find(this.flights, function(flight) { return flight.flight_number == number });

                this.$http.delete('/api/flights/' + flight.id).then((response) => {
                    this.flights.splice(_.indexOf(this.flights, flight), 1);
                }, (response) => {
                   console.log(response);
                });
            },
            isFlightAdded(number) {
                return _.find(this.flights, function(flight) {
                    return flight.flight_number == number
                }) !== undefined;
            }
        }
    }
</script>
