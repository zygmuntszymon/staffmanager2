@extends('layouts.app')
@section('title','Wymień punkty')
@section('content')
    <div class="section">
        <div class="section-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h1 style="margin: 0;"><i class="fa-solid fa-arrows-rotate"></i> Twoje wymiany punktów</h1>
            <div class="points-display" style="background: #25262B; padding: 0.75rem 1.5rem; border-radius: 30px; font-size: 1.25rem;">
                <i class="fa-solid fa-coins" style="color: gold; margin-right: 0.5rem;"></i>
                <strong>{{ auth()->user()->points }}</strong> dostępnych punktów
            </div>
        </div>

        @if(session('status'))
            <div class="alert success" style="background: #4CAF50; color: white; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; display: flex; align-items: center;">
                <i class="fa-solid fa-circle-check" style="margin-right: 0.75rem; font-size: 1.25rem;"></i>
                {{ session('status') }}
            </div>
        @endif

        @error('points')
        <div class="alert error" style="background: #f44336; color: white; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; display: flex; align-items: center;">
            <i class="fa-solid fa-triangle-exclamation" style="margin-right: 0.75rem; font-size: 1.25rem;"></i>
            {{ $message }}
        </div>
        @enderror

        @if($redemptions->isEmpty())
            <div class="empty-state" style="text-align: center; padding: 3rem; background: #25262B; border-radius: 8px;">
                <i class="fa-solid fa-inbox" style="font-size: 3rem; color: #636363; margin-bottom: 1rem;"></i>
                <h3 style="margin: 0 0 0.5rem 0;">Brak historii wymian</h3>
                <p>Nie dokonałeś jeszcze żadnej wymiany punktów.</p>
            </div>
        @else
            <div class="table-container" style="overflow-x: auto;">
                <table>
                    <thead>
                    <tr>
                        <th>Benefit</th>
                        <th>Punkty</th>
                        <th>Data wymiany</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($redemptions as $r)
                        <tr>
                            <td style="display: flex; align-items: center;">
                                @if($r->benefit_type == 'vacation_day')
                                    <i class="fa-solid fa-umbrella-beach" style="font-size: 1.5rem; color: #4CAF50; margin-right: 0.75rem;"></i>
                                    <div>
                                        <div style="font-weight: 500;">Dzień urlopowy</div>
                                        <div style="font-size: 0.85rem; color: #aaa;">+1 dzień urlopu</div>
                                    </div>
                                @else
                                    <i class="fa-solid fa-money-bill-wave" style="font-size: 1.5rem; color: #4CAF50; margin-right: 0.75rem;"></i>
                                    <div>
                                        <div style="font-weight: 500;">Premia pieniężna</div>
                                        <div style="font-size: 0.85rem; color: #aaa;">+{{ number_format(500, 0, '', ' ') }} PLN brutto</div>
                                    </div>
                                @endif
                            </td>
                            <td style="font-weight: bold; color: #FFD700;">
                                <i class="fa-solid fa-coins" style="margin-right: 0.25rem;"></i>
                                {{ number_format($r->points_spent, 0, '', ' ') }} pkt
                            </td>
                            <td>{{ $r->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="section" style="margin-top: 2rem;">
        <h2 style="margin-top: 0;"><i class="fa-solid fa-plus"></i> Nowa wymiana punktów</h2>

        <div class="benefits-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <div class="benefit-card" style="background: #25262B; border-radius: 8px; padding: 1.5rem; transition: transform 0.3s;">
                <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                    <div style="background: #1e2124; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                        <i class="fa-solid fa-umbrella-beach" style="font-size: 1.5rem; color: #4CAF50;"></i>
                    </div>
                    <h3 style="margin: 0;">Dzień urlopowy</h3>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                        <i class="fa-solid fa-coins" style="color: #FFD700; margin-right: 0.5rem;"></i>
                        <span style="font-size: 1.25rem; font-weight: bold;">2 000 pkt</span>
                    </div>
                    <p style="margin: 0; color: #aaa;">Wymieniając punkty otrzymasz dodatkowy dzień urlopowy do wykorzystania.</p>
                </div>
            </div>

            <div class="benefit-card" style="background: #25262B; border-radius: 8px; padding: 1.5rem; transition: transform 0.3s;">
                <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                    <div style="background: #1e2124; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                        <i class="fa-solid fa-money-bill-wave" style="font-size: 1.5rem; color: #4CAF50;"></i>
                    </div>
                    <h3 style="margin: 0;">Premia pieniężna</h3>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                        <i class="fa-solid fa-coins" style="color: #FFD700; margin-right: 0.5rem;"></i>
                        <span style="font-size: 1.25rem; font-weight: bold;">4 000 pkt</span>
                    </div>
                    <p style="margin: 0; color: #aaa;">Wymieniając punkty otrzymasz premię pieniężną w wysokości 500 PLN brutto.</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('redemptions.store') }}" style="background: #25262B; padding: 1.5rem; border-radius: 8px;">
            @csrf
            <h3 style="margin-top: 0;">Wybierz benefit do wymiany</h3>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <label class="benefit-option" style="flex: 1; min-width: 250px; border: 2px solid #36393e; border-radius: 8px; padding: 1rem; cursor: pointer; transition: all 0.3s;">
                        <div style="display: flex; align-items: center;">
                            <input type="radio" id="vacation_day" name="benefit_type" value="vacation_day" required style="margin-right: 0.75rem; width: 1.25rem; height: 1.25rem;">
                            <div>
                                <div style="font-weight: 500; display: flex; align-items: center;">
                                    <i class="fa-solid fa-umbrella-beach" style="margin-right: 0.5rem;"></i> Dzień urlopowy
                                </div>
                                <div style="display: flex; align-items: center; margin-top: 0.25rem;">
                                    <i class="fa-solid fa-coins" style="color: #FFD700; margin-right: 0.5rem;"></i>
                                    <span>2 000 pkt</span>
                                </div>
                            </div>
                        </div>
                    </label>

                    <label class="benefit-option" style="flex: 1; min-width: 250px; border: 2px solid #36393e; border-radius: 8px; padding: 1rem; cursor: pointer; transition: all 0.3s;">
                        <div style="display: flex; align-items: center;">
                            <input type="radio" id="cash_bonus" name="benefit_type" value="cash_bonus" required style="margin-right: 0.75rem; width: 1.25rem; height: 1.25rem;">
                            <div>
                                <div style="font-weight: 500; display: flex; align-items: center;">
                                    <i class="fa-solid fa-money-bill-wave" style="margin-right: 0.5rem;"></i> Premia pieniężna
                                </div>
                                <div style="display: flex; align-items: center; margin-top: 0.25rem;">
                                    <i class="fa-solid fa-coins" style="color: #FFD700; margin-right: 0.5rem;"></i>
                                    <span>4 000 pkt</span>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-button" style="text-align: center;">
                <button type="submit" style="padding: 0.75rem 2.5rem; font-size: 1.1rem; display: inline-flex; align-items: center;">
                    <i class="fa-solid fa-arrows-rotate" style="margin-right: 0.75rem;"></i> Wymień punkty
                </button>
            </div>
        </form>
    </div>

    <style>
        .benefit-option:hover, .benefit-card:hover {
            transform: translateY(-5px);
            border-color: #4CAF50 !important;
        }

        .benefit-option input[type="radio"]:checked + div {
            color: #4CAF50;
        }

        .benefit-option input[type="radio"]:checked {
            accent-color: #4CAF50;
        }

        table tbody tr {
            transition: background 0.2s;
        }

        table tbody tr:hover {
            background: #1e2124;
        }
    </style>
@endsection
