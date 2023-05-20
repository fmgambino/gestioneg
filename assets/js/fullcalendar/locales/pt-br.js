FullCalendar.globalLocales.push(function () {
  'use strict';

  var ptBr = {
    code: "pt-br",
    buttonText: {
      prev: "Anterior",
      next: "Próximo",
      today: "Hoy",
      month: "Mes",
      week: "Semana",
      day: "Día",
      list: "Lista"
    },
    weekText: "Sm",
    allDayText: "dia inteiro",
    moreLinkText: function(n) {
      return "mais +" + n;
    },
    noEventsText: "Não há eventos para mostrar"
  };

  return ptBr;

}());
