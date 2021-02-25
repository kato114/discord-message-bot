<?php

/*
 * This file is apart of the DiscordPHP project.
 *
 * Copyright (c) 2016-2020 David Cole <david.cole1340@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the LICENSE.md file.
 */

namespace Discord\WebSockets\Events;

use Discord\Parts\WebSockets\MessageReaction;
use Discord\WebSockets\Event;
use Discord\Helpers\Deferred;
use Discord\Parts\Channel\Reaction;

class MessageReactionAdd extends Event
{
    /**
     * {@inheritdoc}
     */
    public function handle(Deferred &$deferred, $data): void
    {
        $reaction = new MessageReaction($this->discord, (array) $data, true);

        if ($channel = $reaction->channel) {
            if ($message = $channel->messages->offsetGet($reaction->message_id)) {
                $addedReaction = false;

                foreach ($message->reactions as $react) {
                    if ($react->id == $reaction->reaction_id) {
                        ++$react->count;

                        if ($reaction->user_id == $this->discord->id) {
                            $react->me = true;
                        }

                        $addedReaction = true;
                        break;
                    }
                }

                // New reaction added
                if (! $addedReaction) {
                    $message->reactions->push($message->reactions->create([
                        'count' => 1,
                        'me' => $reaction->user_id == $this->discord->id,
                        'emoji' => $reaction->emoji->getRawAttributes(),
                    ], true));
                }
            }
        }

        $deferred->resolve($reaction);
    }
}
