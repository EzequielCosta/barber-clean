<?php
declare(strict_types=1);

namespace App\Domain\Entities;

final class Servicos
{
    private array $itens;

    public function __construct()
    {
        $this->itens = [];
    }

    /**
     * @param Servico $servico
     * @return void
     */
    public function adicionar(Servico $servico): void
    {
        $this->itens[] = $servico;
    }

    /**
     * @param int $servicoId
     * @return void
     */
    public function removerPeloId(int $servicoId): void
    {

        foreach ($this->itens as $key => $servico) {
            if ($servico->id === $servicoId) {
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
     * @param Servico $servico
     * @return void
     */
    public function removerPeloNomeDoServico(Servico $servico): void
    {

        foreach ($this->itens as $key => $item) {
            if ($servico->nome === $item->nome) {
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
     * @return float
     */
    public function valorTotal(): float
    {
        $soma = 0;
        foreach ($this->itens as $servico) {
            $soma += $servico->getValor();
        }

        return $soma;
    }
}