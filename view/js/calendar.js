document.addEventListener('DOMContentLoaded', function() {
    // Estado atual do calendário
    let currentMonth = new Date().getMonth() + 1; // Mês atual (1-12)
    let currentYear = new Date().getFullYear(); // Ano atual
    
    // Elementos do DOM
    const calendarContainer = document.getElementById('calendar-container');
    
    // Inicialização
    renderCalendar(currentMonth, currentYear);
    
    // Função para renderizar o calendário
    function renderCalendar(month, year) {
        // Nomes dos meses em português
        const monthNames = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril',
            'Maio', 'Junho', 'Julho', 'Agosto',
            'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];
        
        // Calcular informações do mês
        const daysInMonth = new Date(year, month, 0).getDate();
        const firstDayOfMonth = new Date(year, month - 1, 1).getDay();
        
        // Criar a estrutura do calendário
        let calendarHTML = `
            <div class="calendar-content">
                <div class="calendar-header">
                    <div class="month-navigation">
                        <button class="nav-btn prev-month">&#8249;</button>
                        <h2>${monthNames[month-1]} ${year}</h2>
                        <button class="nav-btn next-month">&#8250;</button>
                    </div>
                </div>
                <div class="weekdays">
                    <div>Dom</div><div>Seg</div><div>Ter</div><div>Qua</div><div>Qui</div><div>Sex</div><div>Sáb</div>
                </div>
                <div class="days-grid">
        `;
        
        // Adicionar espaços em branco para os dias antes do primeiro dia do mês
        for (let i = 0; i < firstDayOfMonth; i++) {
            calendarHTML += `<div class="day other-month"></div>`;
        }
        
        // Adicionar os dias do mês
        const today = new Date();
        const isCurrentMonth = (today.getMonth() + 1 === month && today.getFullYear() === year);
        
        for (let day = 1; day <= daysInMonth; day++) {
            const isToday = isCurrentMonth && today.getDate() === day;
            const dayClass = isToday ? 'day current-day' : 'day';
            
            // Aqui podemos adicionar verificação para eventos
            const hasEvent = checkForEvents(year, month, day);
            const eventMarker = hasEvent ? '<div class="event-marker"></div>' : '';
            
            calendarHTML += `<div class="${dayClass}" data-date="${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}">
                ${day}
                ${eventMarker}
            </div>`;
        }
        
        calendarHTML += `
                </div>
                <div class="calendar-actions">
                    <button class="btn add-event">Adicionar Evento</button>
                    <button class="btn view-events">Ver Eventos</button>
                </div>
            </div>
        `;
        
        // Atualizar o conteúdo do calendário
        calendarContainer.innerHTML = calendarHTML;
        
        // Adicionar event listeners para os botões de navegação
        document.querySelector('.prev-month').addEventListener('click', function() {
            navigateMonth(-1);
        });
        
        document.querySelector('.next-month').addEventListener('click', function() {
            navigateMonth(1);
        });
        
        // Adicionar event listeners para dias com eventos
        document.querySelectorAll('.day').forEach(day => {
            day.addEventListener('click', function() {
                const dateStr = this.getAttribute('data-date');
                if (dateStr) {
                    showDayEvents(dateStr);
                }
            });
        });
        
        // Adicionar event listener para o botão de adicionar evento
        document.querySelector('.add-event').addEventListener('click', function() {
            showAddEventForm();
        });
        
        // Adicionar event listener para o botão de ver eventos
        document.querySelector('.view-events').addEventListener('click', function() {
            showAllEvents();
        });
    }
    
    // Função para navegar para o mês anterior ou próximo
    function navigateMonth(direction) {
        // Atualizar o mês e ano
        currentMonth += direction;
        
        // Ajustar para caso o mês fique menor que 1 ou maior que 12
        if (currentMonth < 1) {
            currentMonth = 12;
            currentYear--;
        } else if (currentMonth > 12) {
            currentMonth = 1;
            currentYear++;
        }
        
        // Renderizar o novo calendário
        renderCalendar(currentMonth, currentYear);
    }
    
    // Função para verificar se há eventos para um dia específico
    function checkForEvents(year, month, day) {
        // Aqui você pode implementar a lógica para verificar eventos de um banco de dados ou localStorage
        // Por enquanto, vamos simular alguns eventos
        const sampleEvents = [
            { date: '2025-05-10', title: 'Reunião de Pais' },
            { date: '2025-05-15', title: 'Entrega de Notas' },
            { date: '2025-05-20', title: 'Conselho de Classe' },
            { date: '2025-06-05', title: 'Festa Junina' }
        ];
        
        const dateStr = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
        return sampleEvents.some(event => event.date === dateStr);
    }
    
    // Função para mostrar eventos de um dia específico
    function showDayEvents(dateStr) {
        // Aqui você pode implementar a lógica para mostrar eventos de um dia específico
        // Por exemplo, abrir um modal ou atualizar uma área da página com os eventos do dia
        console.log(`Eventos para ${dateStr}:`);
        
        // Simular a busca de eventos
        const sampleEvents = [
            { date: '2025-05-10', title: 'Reunião de Pais', time: '19:00' },
            { date: '2025-05-15', title: 'Entrega de Notas', time: '15:30' },
            { date: '2025-05-20', title: 'Conselho de Classe', time: '14:00' },
            { date: '2025-06-05', title: 'Festa Junina', time: '18:00' }
        ];
        
        const dayEvents = sampleEvents.filter(event => event.date === dateStr);
        
        if (dayEvents.length > 0) {
            // Aqui você pode mostrar os eventos em um modal ou atualizar o DOM
            dayEvents.forEach(event => {
                console.log(`- ${event.title} às ${event.time}`);
            });
        } else {
            console.log('Nenhum evento neste dia.');
        }
    }
    
    // Função para mostrar formulário de adicionar evento
    function showAddEventForm() {
        // Aqui você pode implementar a lógica para mostrar um formulário para adicionar eventos
        console.log('Abrindo formulário para adicionar evento');
    }
    
    // Função para mostrar todos os eventos
    function showAllEvents() {
        // Aqui você pode implementar a lógica para mostrar todos os eventos
        console.log('Mostrando todos os eventos');
    }
});