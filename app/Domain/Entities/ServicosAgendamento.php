<?php
declare(strict_types=1);

namespace App\Domain\Entities;

final class ServicosAgendamento
{
    public function __construct(private array $itens)
    {
        $this->itens = [];
    }

    /**
     * @param ServicoAgendamento $servicoAgendamento
     * @return void
     */
    public function adicionar(ServicoAgendamento $servicoAgendamento): void
    {
        $this->itens[] = $servicoAgendamento;
    }

    /**
     * @param int $servicoAgendamentoId
     * @return void
     */
    public function removerPeloId(int $servicoAgendamentoId): void
    {

        foreach ($this->itens as $key => $servico) {
            if ($servico->id === $servicoAgendamentoId) {
                unset($this->itens[$key]);
                break;
            }
        }
    }

    /**
     * @param int $indice
     * @return void
     */
    public function removerPeloIndice(int $indice): void
    {
        unset($this->itens[$indice]);
    }

    /**
     * @param ServicoAgendamento $servicoAgendamento
     * @return void
     */
    public function removerPeloNomeDoServico(ServicoAgendamento $servicoAgendamento): void
    {

        foreach ($this->itens as $key => $servico) {
            if ($servicoAgendamento->servico->nome === $servico->servico->nome) {
                unset($this->itens[$key]);
                break;
            }
        }
    }

    /**
     * @return array
     */
    public function getItens(): array
    {
        return $this->itens;
    }

    /**
     * @return int
     */
    public function valorTotal(): int
    {
        $soma = 0;
        foreach ($this->itens as $servicoAgendamento) {
            $soma += $soma;
        }

        return $soma;
    }
}